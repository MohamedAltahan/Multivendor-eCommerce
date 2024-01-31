<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    function index()
    {
        $shippingMethods = ShippingRule::where('status', 'active')->get();
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();
        return view('frontend.pages.checkout', compact('addresses', 'shippingMethods'));
    }
    function createAddress(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'max:200', 'email'],
            'phone' => ['required', 'max:20'],
            'country' => ['required', 'max:200'],
            'state' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip_code' => ['required', 'max:20'],
            'address' => ['required'],
        ]);

        $address = new UserAddress();
        $request['user_id'] = Auth::user()->id;
        $address->create($request->all());
        toastr('Created successfully', 'success', 'success');
        return redirect()->back();
    }
    function submitCheckout(Request $request)
    {
        $request->validate([
            'shipping_method_id' => ['required', 'integer'],
            'shipping_address_id' => ['required', 'integer']
        ]);

        $shippingMethod = ShippingRule::findOrFail($request->shipping_method_id);
        Session::put('shipping_method', [
            'id' => $shippingMethod->id,
            'name' => $shippingMethod->name,
            'type' => $shippingMethod->type,
            'cost' => $shippingMethod->cost,
        ]);

        $address = UserAddress::findOrFail($request->shipping_address_id)->toArray();
        Session::put('address', $address);
        return response(['status' => 'success', 'redirect_url' => route('user.payment')]);
    }
}
