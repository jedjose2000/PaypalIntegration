<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Payment extends Controller
{
    public function payment(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('PHP');
        $paypalToken = $provider->getAccessToken();
        $userId = $request->input('userId');
        $itemName = $request->input('itemName');
        $total = $request->input('numericValue');
        $response = $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment-success'),
                "cancel_url" => route('payment-cancelled')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "PHP",
                        "value" => $total
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return response()->json([
                        'link' => $link['href'],
                        'message' => 'Payment order created successfully',
                    ]);
                }
            }
        } else {
            return redirect()->route('dashboard');
        }

    }

    public function success(Request $request){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('PHP');
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if(isset($response['status']) && isset($response['status']) == 'COMPLETED'){
            return "PAYMENT SUCCESS";
        }else{
            return redirect()->route('payment-cancelled');
        }
    }

    public function cancel(){
        return "Payment is cancelled";
    }





}