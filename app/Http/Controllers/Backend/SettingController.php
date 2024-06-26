<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\LogoSetting;
use App\Models\PusherSetting;
use App\Models\Setting;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use fileUploadTrait;
    public function index()
    {
        $logoSetting = LogoSetting::first() ?: new LogoSetting();
        $setting = Setting::first();
        $emailSettings = EmailConfiguration::first();
        $pusherSetting = PusherSetting::first();
        return view('admin.setting.index', compact('setting', 'emailSettings', 'logoSetting', 'pusherSetting'));
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

    //================================================================
    function logoSettingUpdate(Request $request)
    {
        $request->validate([
            'main_logo' => ['image', 'max:3000'],
            'icon' => ['image', 'max:3000'],
        ]);
        $oldLogos = LogoSetting::first() ?: new LogoSetting();

        $logos = [];

        if ($request->hasFile('main_logo')) {
            $oldMainLogo = $oldLogos['main_logo'];
            $logos['main_logo'] = $this->fileUpdate($request, 'myDisk', 'websiteLogo', 'main_logo', $oldMainLogo);
        }

        if ($request->hasFile('icon')) {
            $oldIcon = $oldLogos['icon'];
            $logos['icon'] = $this->fileUpdate($request, 'myDisk', 'websiteLogo', 'icon', $oldIcon);
        }

        LogoSetting::updateOrCreate(
            ['id' => 1],
            $logos
        );
        toastr('Updated successfully', 'success', 'success');
        return redirect()->back();
    }
    /** Pusher settings update ====================================================================*/
    function pusherSettingUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'pusher_app_id' => ['required'],
            'pusher_key' => ['required'],
            'pusher_secret' => ['required'],
            'pusher_cluster' => ['required'],
        ]);

        PusherSetting::updateOrCreate(
            ['id' => 1],
            $validatedData
        );

        toastr('Updated successfully!', 'success', 'success');
        return redirect()->back();
    }
}
