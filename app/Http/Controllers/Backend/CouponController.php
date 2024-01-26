<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $dataTable)
    {
        return $dataTable->render('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:200'],
            'code' => ['required', 'max:200'],
            'quantity' => ['required', 'integer'],
            'max_use_per_person' => ['required', 'integer'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'discount_type' => ['required', 'in:percent,fixed'],
            'discount_value' => ['required', 'integer'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $coupon = new Coupon();
        $coupon->create($request->all());
        toastr('Created successfully', 'success', 'success');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $coupon = Coupon::findOrFail($id);
        $request->validate([
            'name' => ['required', 'max:200'],
            'code' => ['required', 'max:200'],
            'quantity' => ['required', 'integer'],
            'max_use_per_person' => ['required', 'integer'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'discount_type' => ['required', 'in:percent,fixed'],
            'discount_value' => ['required', 'integer'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $coupon->update($request->all());
        toastr('Updated successfully', 'success', 'success');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return response(['message' => 'Deleted successfully', 'status' => 'success']);
    }
    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $category = Coupon::findOrFail($request->id);

        $request->status == "true" ? $category->status = 'active' : $category->status = 'inactive';
        $category->save();

        return response(['message' => 'Status has been updated']);
    }
}
