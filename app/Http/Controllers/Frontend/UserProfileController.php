<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.profile');
    }
    //update profile info-------------------------------------------------------
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'image' => ['image', 'max:2048']
        ]);
        $user = Auth::user();
        $profileData = $request->except(['image', '_method', '_token']); //array
        //get the old image name
        $oldImage = $user->image;
        //store the new image
        $newImage = $this->uploadImage($request);
        if ($request->hasFile('image')) {
            $profileData['image'] = $newImage;
        }
        // updata all user data
        User::where('id', Auth::user()->id)->update($profileData);
        if ($oldImage && $newImage) {
            Storage::disk('myDisk')->delete($oldImage);
        }
        toastr()->success('Profile updated successfully');
        return redirect()->back();
    }
    //user update password ----------------------------------------------------------------
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            //current_password ->check the current user password from database
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);
        toastr()->success('Password updated successfully');
        return redirect()->back();
    }
    //-----------------------------------------------------------------------------------------
    //it take the file from the request then store it, then returns the path
    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        //it returns object of uploaded file object
        $image = $request->file('image');
        //takes (folderName,name of the disk )to store the file and returns the path
        $path = $image->store('userProfile', ['disk' => 'myDisk']);
        return $path;
    }
}
