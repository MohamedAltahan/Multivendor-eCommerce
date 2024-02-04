<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class StripeSettingController extends Controller
{
    function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:enable,disable'],
            'mode' => ['required', 'in:sandbox,live'],
            'country' => ['required', 'max:200'],
            'currency' => ['required', 'max:200'],
            'exchange_rate' => ['required'],
            'clint_id' => ['required'],
            'secret_key' => ['required'],
        ]);

        StripeSetting::updateOrCreate(
            ['id' => $id],
            $request->all()
        );
        toastr('Updated Successfully', 'success', 'success');
        return redirect()->back();
    }
}
