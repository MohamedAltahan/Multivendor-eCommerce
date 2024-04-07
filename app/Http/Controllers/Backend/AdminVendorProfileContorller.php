<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileContorller extends Controller
{
    use fileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile =  Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
        return view('admin.vendor-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['nullable', 'image', 'max:2000'],
            'shop_name' => ['required', 'max:255'],
            'phone' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:200'],
            'address' => ['required'],
            'description' => ['required'],
            'fb_link' => ['nullable', 'url'],
            'insta_link' => ['nullable', 'url'],
            'tw_link' => ['nullable', 'url'],
        ]);
        $vendor = Vendor::where('user_id', Auth::guard('admin')->user()->id)->first();
        $vendorData = $request->except('banner');
        if ($request->hasFile('banner')) {
            $oldBannerPath = $vendor->banner;
            $vendorData['banner'] = $this->fileUpdate($request, 'myDisk', 'vendor-banner', 'banner', $oldBannerPath);
        }
        $vendor->update($vendorData);
        toastr('Updated successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
