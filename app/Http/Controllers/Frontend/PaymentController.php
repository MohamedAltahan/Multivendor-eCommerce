<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    function index()
    {
        if (!Session::has('address')) {
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }

    //payment success======================================================
    function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    //paypal redirect======================================================
    function payWithPaypal()
    {
        $paypalSetting = PaypalSetting::first();
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        //calc final payable amount depends on exchange rate
        $finalTotal = round(finalPaymentAmount() * $paypalSetting->exchange_rate, 2);


        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('user.paypal.success'), // after payment done , redirect to success url
                'cancel_url' => route('user.paypal.cancel'),
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => $config['currency'],
                        'value' => $finalTotal,
                    ]
                ]
            ]
        ]);


        if (isset($response['id']) && $response['id'] != null) {

            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }

    //paypalconfiguration===================================================

    function paypalConfig()
    {
        $paypalSetting = PaypalSetting::first();
        $config = [
            'mode'    => $paypalSetting->mode,

            'sandbox' => [
                'client_id'         => $paypalSetting->clint_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => 'APP-80W284485P519543T',
            ],

            'live' => [
                'client_id'         => $paypalSetting->clint_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => 'APP-80W284485P519543T',
            ],

            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => $paypalSetting->currency,
            'notify_url'     =>  '', // Change this accordingly for your application.
            'locale'         =>  'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   =>  true, // Validate SSL when creating api client.
        ];
        return $config;
    }

    //paypal success user will be redirected to this ===============================================
    function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('user.payment.success');
        }

        return redirect()->route('user.paypal.cancel');
    }
    //paypal success user will be redirected to this ===============================================
    function paypalCancel(Request $request)
    {
        toastr('Something went wrong, please try again');
        return redirect()->route('user.payment');
    }
}//end class
