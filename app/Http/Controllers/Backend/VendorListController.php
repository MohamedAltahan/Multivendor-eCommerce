<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendorListController extends Controller
{
    function index(VendorListDataTable $datatable)
    {
        return $datatable->render('admin.vendor-list.index');
    }

    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $user = User::findOrFail($request->id);

        $request->status == "true" ? $user->status = 'active' : $user->status = 'inactive';
        $user->save();

        return response(['message' => 'Status has been updated']);
    }
}
