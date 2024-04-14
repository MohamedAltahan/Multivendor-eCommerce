<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    //index-------------------------------------------------------------------
    public function index()
    {
        return view('admin.profile.index');
    }
    // user profile update----------------------------------------------------------
    public function profileUpdate(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:admins,email,' . Auth::guard('admin')->user()->id],
            'image' => ['image', 'max:2048']
        ]);

        $user = Auth::guard('admin')->user();
        $profileData = $request->except('image', '_token'); //array
        //get the old image name
        $oldImage = $user->image;
        //store the new image
        $newImage = $this->uploadImage($request);
        if ($request->hasFile('image')) {
            $profileData['image'] = $newImage;
        }
        Admin::where('id', Auth::guard('admin')->user()->id)->update($profileData);
        if ($oldImage && $newImage) {
            Storage::disk('myDisk')->delete($oldImage);
        }
        toastr()->success('Profile updated successfully');
        return redirect()->back();
    }

    //Admin update password ----------------------------------------------------------------
    public function passwordUpdate(Request $request)
    {
        dd('fkd');
        $request->validate([
            //current_password ->check the current user password from database
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user('admin')->update([
            'password' => bcrypt($request->password)
        ]);
        toastr()->success('Password updated successfully');
        return redirect()->back();
    }


    //it take the file from the request then store it, then returns the path
    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        //it returns object of uploaded file object
        $image = $request->file('image');
        //takes (folderName,name of the disk )to store the file and returns the path
        $path = $image->store('profile', ['disk' => 'myDisk']);
        return $path;
    }
}
