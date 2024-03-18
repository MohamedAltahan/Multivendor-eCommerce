<?php

namespace App\Http\Controllers\Backend;


use App\DataTables\VendorVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorVariantDataTable $dataTable)
    {
        return $dataTable->render('vendor.product.variant.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.product.variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['integer', 'required'],
            'vendor_id' => ['integer', 'required'],
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);
        // $variant =new Variant();
        // $variant->create($request->all());
        toastr('Created successfully');
        return redirect()->route('vendor.variant.index', ['product_id' => $request->product_id]);
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

        // $variant = Variant::findOrFail($id);
        // if ($variant->vendor_id != Auth::user()->vendor->id) {
        //     abort(404);
        // }
        return view('vendor.product.variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);
        // $variant =  Variant::findOrFail($id);
        // if ($variant->vendor_id != Auth::user()->vendor->id) {
        //     abort(404);
        // }
        // $variant->update($request->all());
        toastr('Updated Successfully');
        // return redirect()->route('vendor.variant.index', ['product_id' => $variant->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $variant = Variant::findOrFail($id);
        // if ($variant->vendor_id != Auth::user()->vendor->id) {
        //     abort(404);
        // }
        // $variantValuesCheckExist = VariantDetails::where('product_variant_type_id', $variant->id)->count();
        // if ($variantValuesCheckExist > 0) {
        //     return response(['status' => 'error', 'message' => 'this variant contains items inside, you must delete them first']);
        // }
        // $variant->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }

    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        // $variant = Variant::findOrFail($request->id);

        // $request->status == "true" ? $variant->status = 'active' : $variant->status = 'inactive';
        // $variant->save();

        return response(['message' => 'Status has been updated']);
    }
}
