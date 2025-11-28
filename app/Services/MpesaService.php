<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MpesaService
{
    public function getAccessToken()
    {
        $key = config('mpesa.consumer_key');
        $secret = config('mpesa.consumer_secret');

        $url = config('mpesa.env') === 'live'
            ? config('mpesa.urls.live') . '/oauth/v1/generate?grant_type=client_credentials'
            : config('mpesa.urls.sandbox') . '/oauth/v1/generate?grant_type=client_credentials';

        $response = Http::withBasicAuth($key, $secret)->get($url);

        if (!$response->successful()) {
              Log::error('MPESA TOKEN ERROR', ['status' => $response->status(), 'body' => $response->body()]);
            return null;
        }

        return $response->json()['access_token'] ?? null;
    }

    public function stkPush($phone, $amount, $reference, $description, $callbackUrl)
    {
        $shortcode = config('mpesa.shortcode');
        $passkey   = config('mpesa.passkey');

        $timestamp = now()->format('YmdHis');
        $password  = base64_encode($shortcode . $passkey . $timestamp);

        $url = config('mpesa.env') === 'live'
            ? config('mpesa.urls.live') . '/mpesa/stkpush/v1/processrequest'
            : config('mpesa.urls.sandbox') . '/mpesa/stkpush/v1/processrequest';

        $token = $this->getAccessToken();

        if (!$token) {
            return ['error' => 'Failed to generate access token'];
        }

        $payload = [
            'BusinessShortCode' => $shortcode,
            'Password'          => $password,
            'Timestamp'         => $timestamp,
            'TransactionType'   => 'CustomerPayBillOnline',
            'Amount'            => (int) $amount,
            'PartyA'            => $phone,
            'PartyB'            => $shortcode,
            'PhoneNumber'       => $phone,
            'CallBackURL'       => $callbackUrl,
            'AccountReference'  => $reference,
            'TransactionDesc'   => $description
        ];

        Log::info('MPESA STK Payload', $payload);

        $response = Http::withToken($token)->post($url, $payload);

        if (!$response->successful()) {
            Log::info('M-Pesa STK Response', ['status' => $response->status(), 'body' => $response->body()]);
            return $response->json();
        }

        return $response->json();
    }
}
