<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $paypalSetting = PaypalSetting::first();
            $finalTotal = round(finalPaymentAmount() * $paypalSetting->exchange_rate, 2);
            $this->storeOrder('paypal', 'completed', $response['id'], $finalTotal, $paypalSetting->currency);
            $this->clearSession();
            return redirect()->route('user.payment.success');
        }

        return redirect()->route('user.paypal.cancel');
    }

    //paypal success user will be redirected to this ===============================================
    function paypalCancel(Request $request)
    {
        toastr('Something went wrong, please try again', 'error', 'error');
        return redirect()->route('user.payment');
    }

    //store order====================================================================================
    function storeOrder($paymentMethod, $paymentStatus, $transactionId, $paidAmount, $localCurrencyName)
    {
        $setting = Setting::first();

        $order = new Order();
        $order->invoice_id = uniqid();
        $order->user_id = Auth::user()->id;
        $order->sub_total = getMainCartTotal();
        $order->final_total = finalPaymentAmount();
        $order->currency = $setting->currency; //default for the website
        $order->product_quantity = Cart::content()->count();
        $order->payment_method  = $paymentMethod;
        $order->payment_status  = $paymentStatus;
        $order->order_address = json_encode(Session::get('address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->coupon = json_encode(Session::get('coupon'));
        $order->order_status = 'pending';
        $order->save();

        //store order products------------
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->product_name = $product->name;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;
            $orderProduct->save();
        }

        //transaction
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->final_price = finalPaymentAmount();
        $transaction->final_price_in_local_currency = $paidAmount;
        $transaction->local_currency_name = $localCurrencyName;
        $transaction->save();
    }

    //clear session==========================================================================
    function clearSession()
    {
        Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
        Session::forget('coupon');
    }

    //stripe payment============================================================================
    function payWithStripe(Request $request)
    {
        dd($request->all());
    }
}//end class
