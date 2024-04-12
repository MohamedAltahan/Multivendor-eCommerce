<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\FrontendSection;
use App\Models\Slider;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    use fileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        $section = FrontendSection::first()->value;
        $sectionStatus = @json_decode($section)->mainBanner;

        return $dataTable->render('admin.slider.index', compact('sectionStatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'banner_image' => ['required', 'image', 'max:2048'],
            'banner_url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required'],
        ]);

        $sliderInfo = $request->except('banner_image'); //except converts obj to array
        $sliderInfo['banner_image'] = $this->fileUplaod($request, 'myDisk', 'slider', 'banner_image');
        Slider::create($sliderInfo);
        toastr('Created successfully');
        return redirect()->route('admin.slider.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'banner_image' => ['nullable', 'image', 'max:2048'],
            'banner_url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required'],
        ]);
        $slider = Slider::findOrFail($id);
        $oldImagePath = $slider->banner_image;
        $sliderInfo = $request->except('banner_image'); //except converts obj to array
        if ($request->hasFile('banner_image')) {
            $sliderInfo['banner_image'] = $this->fileUpdate($request, 'myDisk', 'slider', 'banner_image', $oldImagePath);
        }
        $slider->update($sliderInfo);
        toastr('Updated successfully');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        //delete an image related to this slider
        if ($slider->banner_image) {
            $this->deleteFile('myDisk', $slider->banner_image);
        }
        //delete the slider itself from database
        $slider->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }
}
