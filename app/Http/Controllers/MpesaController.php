<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MpesaController extends Controller
{
    // 1. Generate Access Token
    public function token()
    {
        $response = Http::withBasicAuth(
            env('MPESA_CONSUMER_KEY'),
            env('MPESA_CONSUMER_SECRET')
        )->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        return $response->json();
    }

    // 2. Send STK Push
    public function stkPush(Request $request)
    {
        $phone = $request->phone;
        $amount = $request->amount;

        $timestamp = date('YmdHis');
        $password = base64_encode(env('MPESA_SHORTCODE') . env('MPESA_PASSKEY') . $timestamp);

        // Get access token
        $tokenData = $this->token();
        $token = $tokenData['access_token'];

        $response = Http::withToken($token)->post(
            'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
            [
                "BusinessShortCode" => env('MPESA_SHORTCODE'),
                "Password" => $password,
                "Timestamp" => $timestamp,
                "TransactionType" => "CustomerPayBillOnline",
                "Amount" => $amount,
                "PartyA" => $phone,
                "PartyB" => env('MPESA_SHORTCODE'),
                "PhoneNumber" => $phone,
                "CallBackURL" => env('MPESA_CALLBACK_URL'),
                "AccountReference" => "Test Payment",
                "TransactionDesc" => "Payment for testing"
            ]
        );

        return $response->json();
    }

    // 3. Callback URL
    public function callback(Request $request)
    {
        \Log::info("MPESA CALLBACK:", $request->all());
        return response()->json(["Result" => "Callback received"]);
    }
}
