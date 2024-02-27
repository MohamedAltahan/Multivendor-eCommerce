<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreatedMail;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ManageUserController extends Controller
{
    function index()
    {
        return view('admin.manage-user.index');
    }
    function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'role' => ['required', 'in:user,admin,vendor'],
        ]);

        $userInfo = $request->except('password');

        if ($userInfo['role'] == 'user') {
            $userInfo['password'] = bcrypt($request->password);
            $userInfo['status'] = 'active';
            User::create($userInfo);
        } else {
            $userInfo['password'] = bcrypt($request->password);
            $userInfo['status'] = 'active';
            User::create($userInfo);
            //create default vendor profile
            Vendor::create([
                'banner' => 'Admin',
                'shop_name' => $userInfo['name'] . ' shop',
                'phone' => '123456789',
                'email' => 'test@gmail.com',
                'address' => 'usa',
                'description' => 'shop description',
                'user_id' => auth()->user()->id,
                'status' => 'active',
            ]);
        }
        Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->email, $request->password));
        toastr('Created Successfully', 'success', 'success');
        return redirect()->back();
    }
}
