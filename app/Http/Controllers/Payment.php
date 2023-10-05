<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\OrderModel;
use Carbon\Carbon;
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
        $quantity = $request->input('quantity');
        $response = $provider->createOrder([
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
                    $request->session()->put('paymentData', [
                        'userId' => $userId,
                        'itemName' => $itemName,
                        'total' => $total,
                        'quantity' => $quantity,
                    ]);
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
        $paymentData = $request->session()->get('paymentData');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('PHP');
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if(isset($response['status']) && isset($response['status']) == 'COMPLETED'){
            $data = OrderModel::create([
                'accountId' => $paymentData['userId'],
                'itemName' => $paymentData['itemName'],
                'totalPrice' => $paymentData['total'],
                'quantity'=>$paymentData['quantity'],
                'orderDate' => Carbon::now(),
                'initialprice'=>  $paymentData['total'] / $paymentData['quantity'],
                'paymentType'=> 'Paypal',
                'refNum'=> $response['id']
            ]);
            if ($data) {
                $request->session()->flash('success', 'Payment was successful.');
            } else {
                $request->session()->flash('failure', 'Payment failed.');
            }
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('payment-cancelled');
        }
    }

    public function cancel(Request $request){
        $request->session()->flash('cancelled', 'Payment was successful.');
        return redirect()->route('dashboard');
    }





}