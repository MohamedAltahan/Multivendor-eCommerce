<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BecomeVendor;
use Illuminate\Http\Request;

class BecomeVendorController extends Controller
{
    function index()
    {
        $content = BecomeVendor::first();
        return view('admin.become-vendor.index', compact('content'));
    }

    //_______________________________________________________________________
    function update(Request $request)
    {
        $request->validate([
            'content' => ['required']
        ]);

        BecomeVendor::updateOrCreate(
            ['id' => 1],
            [
                'content' => $request->content
            ]
        );
        toastr('Updated successfully!', 'success', 'success');
        return redirect()->back();
    }
}
