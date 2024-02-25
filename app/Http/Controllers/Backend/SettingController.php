<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $emailSettings = EmailConfiguration::first();
        return view('admin.setting.index', compact('setting', 'emailSettings'));
    }

    //===============================================================
    public function generalSettingUpdate(Request $request)
    {
        $request->validate([
            'site_name' => ['required', 'max:200'],
            'currency_symbol' => ['required', 'max:20'],
            'layout' => ['required', 'max:200'],
            'contact_email' => ['required', 'max:200'],
            'contact_phone' => ['max:50'],
            'contact_address' => ['max:250'],
            'currency' => ['required', 'max:200'],
            'time_zone' => ['required', 'max:200'],
        ]);

        Setting::updateOrCreate(['id' => 1], $request->all());
        toastr('Updated successfully', 'success', 'success');
        return redirect()->back();
        // return view('admin.setting.index');
    }

    //=============================================================
    function stmpSettingUpdate(Request $request)
    {
        $request->validate([
            'sender_email' => ['required', 'email'],
            'host' => ['required', 'max:200'],
            'username' => ['required', 'max:200'],
            'password' => ['required', 'max:200'],
            'port' => ['required', 'max:200'],
            'encryption' => ['required', 'max:200'],
        ]);
        EmailConfiguration::updateOrCreate(
            ['id' => 1],
            $request->all()
        );
        toastr('Updated successfully', 'success', 'success');
        return redirect()->back();
    }
}
