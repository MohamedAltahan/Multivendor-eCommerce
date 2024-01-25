<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting.index', compact('setting'));
    }

    public function generalSettingUpdate(Request $request)
    {
        $request->validate([
            'site_name' => ['required', 'max:200'],
            'layout' => ['required', 'max:200'],
            'contact_email' => ['required', 'max:200'],
            'currency' => ['required', 'max:200'],
            'time_zone' => ['required', 'max:200'],
        ]);

        Setting::updateOrCreate(['id' => 1], $request->all());
        toastr('Updated successfully', 'success', 'success');
        return redirect()->back();
        // return view('admin.setting.index');
    }
}
