<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\WithdrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class WithdrawTransactionController extends Controller
{
    function index(WithdrawRequestDataTable $dataTable)
    {
        return $dataTable->render('admin.withdraw-transaction.index');
    }

    //====================================================================================
    function show($id)
    {
        $request = WithdrawRequest::findOrFail($id);
        return view('admin.withdraw-transaction.show', compact('request'));
    }

    //====================================================================================
    function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:pending,paid,declined']
        ]);

        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->status = $request->status;
        $withdraw->save();

        toastr('Updated successfully!');

        return redirect()->route('admin.withdraw-transaction.index');
    }
}
