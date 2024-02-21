<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use fileUploadTrait;

    function index()
    {
        $banner1 = Advertisement::where('key', 'homepage_banner1')->first();
        $banner1 = @json_decode($banner1->value, true);
        $banner2 = Advertisement::where('key', 'homepage_banner2')->first();
        $banner2 = @json_decode($banner2->value, true);
        // dd($banner2);
        return view('admin.advertisement.index', compact('banner1', 'banner2'));
    }

    function homePageBanner1(Request $request)
    {

        $request->validate([
            'banner' => ['image'],
            'url' => ['required'],
        ]);

        $value = [
            'banner1' => [
                'url' => $request->url,
                'status' => $request->status == 'on' ? 'on' : 'off',
            ]
        ];

        if ($request->hasFile('banner')) {
            $value['banner1']['banner'] =  $this->fileUpdate($request, 'myDisk', 'homeBanner', 'banner');
        } else {
            $banner1 = Advertisement::where('key', 'homepage_banner1')->first();
            $oldbannerPath = @json_decode($banner1->value)->banner1->banner;
            if (!empty($oldbannerPath)) {
                $value['banner1']['banner'] = $oldbannerPath;
            }
        }

        $value = json_encode($value);
        Advertisement::updateOrCreate(
            ['key' => 'homepage_banner1'],
            ['value' => $value]
        );

        toastr('Updated successfully', 'success', 'success');
        return redirect()->back();
    }

    function homePageBanner2(Request $request)
    {
        $request->validate([
            'banner1' => ['image'],
            'banner2' => ['image'],
            'url1' => ['required'],
            'url2' => ['required'],
        ]);

        $value = [
            'banner1' => [
                'url1' => $request->url1,
                'status1' => $request->status1 == 'on' ? 'on' : 'off',
            ],
            'banner2' => [
                'url2' => $request->url2,
                'status2' => $request->status2 == 'on' ? 'on' : 'off',
            ]
        ];
        //left image---------------------------
        if ($request->hasFile('banner1')) {
            $value['banner1']['banner1'] =  $this->fileUpdate($request, 'myDisk', 'homeBanner', 'banner1');
        } else {
            $banner2 = Advertisement::where('key', 'homepage_banner2')->first();
            $oldbannerPath = @json_decode($banner2->value)->banner2->banner1;
            if (!empty($oldbannerPath)) {
                $value['banner1']['banner1'] = $oldbannerPath;
            }
        }
        //right image--------------------------
        if ($request->hasFile('banner2')) {
            $value['banner2']['banner2'] =  $this->fileUpdate($request, 'myDisk', 'homeBanner', 'banner2');
        } else {
            $banner2 = Advertisement::where('key', 'homepage_banner2')->first();
            $oldbannerPath = @json_decode($banner2->value)->banner2->banner2;
            if (!empty($oldbannerPath)) {
                $value['banner2']['banner2'] = $oldbannerPath;
            }
        }

        $value = json_encode($value);
        Advertisement::updateOrCreate(
            ['key' => 'homepage_banner2'],
            ['value' => $value]
        );

        toastr('Updated successfully', 'success', 'success');
        return redirect()->back();
    }
}
