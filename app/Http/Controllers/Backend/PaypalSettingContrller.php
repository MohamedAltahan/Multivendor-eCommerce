<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;

class PaypalSettingContrller extends Controller
{


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        PaypalSetting::updateOrCreate(
            ['id' => $id],
            $request->all()
        );
        toastr('Updated Successfully', 'success', 'success');
        return redirect()->back();
    }
}
