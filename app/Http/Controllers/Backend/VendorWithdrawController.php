<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorWithdrawDataTable;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\withdraw;
use App\Models\withdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VendorWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorWithdrawDataTable $dataTable)
    {

        $vendorTotalSales = OrderProduct::where('vendor_id', auth()->user()->id)
            ->whereHas('order', function ($query) {
                $query->where(['order_status' => 'delivered', 'payment_status' => 'completed']);
            })
            ->sum(DB::raw('(unit_price * qty) + variants_total'));
        $vendorTotalWithdraw = WithdrawRequest::where(['status' => 'paid', 'vendor_id' => auth()->user()->id])->sum('total_amount');
        $vendorCurrentBalance = $vendorTotalSales - $vendorTotalWithdraw;
        $vendorPendingAmount =  WithdrawRequest::where(['status' => 'pending', 'vendor_id' => auth()->user()->id])->sum('total_amount');

        return $dataTable->render('vendor.withdraw.index', compact('vendorTotalWithdraw', 'vendorCurrentBalance', 'vendorPendingAmount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $withdrawMethods = withdrawMethod::all();
        return view('vendor.withdraw.create', compact('withdrawMethods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'method' => ['required', 'integer'],
            'withdraw_amount' => ['required', 'numeric'],
            'account_info' => ['required', 'max:2000'],
        ]);
        $method = withdrawMethod::findOrFail($request->method);
        if ($request->withdraw_amount < $method->minimum_amount || $request->withdraw_amount > $method->maximum_amount) {
            throw ValidationException::withMessages(["Please enter withdraw amount between the range"]);
        }

        $vendorTotalSales = OrderProduct::where('vendor_id', auth()->user()->id)
            ->whereHas('order', function ($query) {
                $query->where(['order_status' => 'delivered', 'payment_status' => 'completed']);
            })
            ->sum(DB::raw('(unit_price * qty) + variants_total'));
        $vendorTotalWithdraw = WithdrawRequest::where(['status' => 'paid', 'vendor_id' => auth()->user()->id])->sum('total_amount');
        $vendorCurrentBalance = $vendorTotalSales - $vendorTotalWithdraw;

        //check current balance first
        if ($request->withdraw_amount > $vendorCurrentBalance) {
            throw ValidationException::withMessages(['You do not have enough balance']);
        }
        //check previous withdraw request

        if (WithdrawRequest::where(['vendor_id' => auth()->user()->id, 'status' => 'pending'])->exists()) {
            throw ValidationException::withMessages(['You already have pending request']);
        }


        $withdraw = new WithdrawRequest();
        $withdraw->vendor_id = auth()->user()->id;
        $withdraw->method = $method->name;
        //before cutout percentage
        $withdraw->total_amount = $request->withdraw_amount;
        //after cutout percentage
        $withdraw->withdraw_amount = $request->withdraw_amount - ($method->withdraw_charge / 100) * $request->withdraw_amount;
        $withdraw->withdraw_charge = ($method->withdraw_charge / 100) * $request->withdraw_amount;
        $withdraw->account_info = $request->account_info;
        $withdraw->status = 'pending';
        $withdraw->save();

        toastr('Request added successfully');

        return redirect()->route('vendor.withdraw.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $methosInfo = withdrawMethod::findOrFail($id);
        return response($methosInfo);
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
    //===========================================================
    public function showRequestDetails(string $id)
    {
        $request = WithdrawRequest::where('vendor_id', auth()->user()->id)->findOrFail($id);
        return view('vendor.withdraw.show', compact('request'));
    }
}
