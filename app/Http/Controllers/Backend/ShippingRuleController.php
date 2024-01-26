<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $dataTable)
    {
        return $dataTable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'type' => ['required', 'in:flat_cost,min_cost'],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $shippingRule = new ShippingRule();
        $shippingRule->create($request->all());
        toastr('Created successfully', 'success', 'success');
        return redirect()->route('admin.shipping-rule.index');
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
        $shippingRule = ShippingRule::findOrFail($id);
        return view('admin.shipping-rule.edit', compact('shippingRule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shippingRule = ShippingRule::findOrFail($id);

        $request->validate([
            'name' => ['required', 'max:200'],
            'type' => ['required', 'in:flat_cost,min_cost'],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $shippingRule->update($request->all());
        toastr('Updated successfully', 'success', 'success');
        return redirect()->route('admin.shipping-rule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shippingRule = ShippingRule::findOrFail($id);
        $shippingRule->delete();
        return response(['message' => 'Deleted successfully', 'status' => 'success']);
    }

    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $flashSaleItem = ShippingRule::findOrFail($request->id);

        $request->status == "true" ? $flashSaleItem->status = 'active' : $flashSaleItem->status = 'inactive';
        $flashSaleItem->save();

        return response(['message' => 'Status has been updated', 'status' => 'success']);
    }
}
