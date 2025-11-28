<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use App\Models\Purchase;

class PaymentController extends Controller
{
    public function initiateStk(Request $request, Post $post)
    {
        // Accept Kenyan phone formats: 07XXXXXXXX, 7XXXXXXXX, or 2547XXXXXXXX
        $request->validate([
            'phone' => ['required', 'regex:/^(0\d{9}|7\d{8}|2547\d{8})$/']
        ]);

    if ($post->price <= 0) {
        return back()->with('error', 'This post is free.');
    }

    $phone = $this->formatPhone($request->phone);
    $amount = (int) $post->price;
    $reference = 'POST-' . $post->id;
    $description = 'Payment for Post: ' . $post->title;
    // Use public callback URL from config (set in .env) if available, otherwise fallback to route
    $callbackUrl = config('mpesa.callback') ?: route('user.mpesa.callback');

    $mpesa = new \App\Services\MpesaService();
    $response = $mpesa->stkPush($phone, $amount, $reference, $description, $callbackUrl);

        Log::info('STK Response', $response);

        // ResponseCode may be integer 0 or string '0' depending on API client; cast to int for safety.
        if (!isset($response['ResponseCode']) || (int) ($response['ResponseCode'] ?? 1) !== 0) {
            return back()->with('error', $response['errorMessage'] ?? ($response['error'] ?? 'Failed to send STK push'));
        }

    Purchase::create([
        'user_id'       => auth()->id(),
        'post_id'       => $post->id,
        'amount'        => $amount,
        'status'        => 'pending',
        'mpesa_receipt' => $response['CheckoutRequestID'] ?? null,
        'phone'         => $phone,
    ]);

    return back()->with('success', 'STK Push sent! Enter your M-Pesa PIN on your phone.');
}

    public function mpesaCallback(Request $request)
    {
        Log::info('MPESA CALLBACK', $request->all());

        $data = $request->all();

        if (!isset($data['Body']['stkCallback'])) {
            return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Invalid callback']);
        }

        $callback = $data['Body']['stkCallback'];

        // If ResultCode is non-zero the payment failed or was cancelled
        if (($callback['ResultCode'] ?? 1) != 0) {
            Log::warning('MPESA STK Push failed', ['callback' => $callback]);
            return response()->json(['ResultCode' => 0]);
        }

        $checkoutRequestID = $callback['CheckoutRequestID'] ?? null;
        $items = collect($callback['CallbackMetadata']['Item'] ?? []);
        $amount  = $items->firstWhere('Name', 'Amount')['Value'] ?? 0;
        $receipt = $items->firstWhere('Name', 'MpesaReceiptNumber')['Value'] ?? null;
        $ref     = $items->firstWhere('Name', 'AccountReference')['Value'] ?? null;

        // Try matching by CheckoutRequestID (stored earlier as mpesa_receipt), then fallback to AccountReference (POST-...)
        $purchase = null;

        if ($checkoutRequestID) {
            $purchase = Purchase::where('mpesa_receipt', $checkoutRequestID)
                ->where('status', 'pending')
                ->latest()
                ->first();
        }

        if (!$purchase && is_string($ref) && str_starts_with($ref, 'POST-')) {
            $postId = (int) str_replace('POST-', '', $ref);

            $purchase = Purchase::where('post_id', $postId)
                ->where('status', 'pending')
                ->latest()
                ->first();
        }

        if ($purchase) {
            $purchase->update([
                'status'        => 'paid',
                'amount'        => $amount ?: $purchase->amount,
                'mpesa_receipt' => $receipt ?? $checkoutRequestID
            ]);

            Log::info('Purchase marked paid', ['purchase_id' => $purchase->id]);
        } else {
            Log::warning('MPESA callback: no matching pending purchase found', [
                'checkoutRequestID' => $checkoutRequestID,
                'accountReference' => $ref,
                'items' => $items->toArray()
            ]);
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Callback processed successfully']);
    }

    /**
     * Normalize phone number to 2547XXXXXXXX format.
     */
    private function formatPhone(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone); // keep digits only

        if (str_starts_with($phone, '0')) {
            return '254' . substr($phone, 1);
        }

        if (str_starts_with($phone, '7')) {
            return '254' . $phone;
        }

        if (str_starts_with($phone, '254')) {
            return $phone;
        }

        // fallback: assume it's already ok
        return $phone;
    }
}
