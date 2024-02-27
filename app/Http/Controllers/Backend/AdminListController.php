<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminListDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    function index(AdminListDataTable $dataTable)
    {

        return $dataTable->render('admin.admin-list.index');
    }
    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $admin = User::findOrFail($request->id);

        $request->status == "true" ? $admin->status = 'active' : $admin->status = 'inactive';
        $admin->save();

        return response(['message' => 'Status has been updated']);
    }
    function destroy($id)
    {
        $admin = User::findOrFail($id);
        $adminProduct = Product::where('vendor_id', @$admin->vendor->id)->first();
        if (!empty($adminProduct)) {
            return response(['status' => 'error', 'message' => 'admin cannot be deleted, deactive this
            admin instead delete']);
        }

        Vendor::where('user_id', $id)->delete();
        $admin->delete();
        return response(['status' => 'success', 'message' => 'admin deleted successfully']);
    }
}
