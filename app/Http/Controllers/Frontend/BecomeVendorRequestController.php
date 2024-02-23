<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BecomeVendorRequestController extends Controller
{
    use fileUploadTrait;
    function index()
    {
        return view('frontend.dashboard.become-vendor-request.index');
    }

    function create(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'image', 'max:3000'],
            'shop_name' => ['required', 'max:200'],
            'email' => ['required', 'email', 'max:200'],
            'address' => ['required', 'max:200'],
            'phone' => ['required', 'max:100'],
            'description' => ['required'],
        ]);
        $vendor = new Vendor();
        $vendorInfo = $request->except('banner');
        $vendorInfo['user_id'] = Auth::user()->id;
        if ($request->hasFile('banner')) {
            $vendorInfo['banner'] = $this->fileUplaod($request, 'myDisk', 'vendor-banner', 'banner');
        }
        $vendor->create($vendorInfo);
        toastr('Submitted successfully', 'success', 'success');
        return redirect()->back();
    }
}
