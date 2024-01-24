<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductVariantType;
use Illuminate\Http\Request;

class ProductVariantTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    //get product attributes by ajax
    public function getProductAttributes()
    {
        $allAttributes = ProductVariantType::get('attribute');
        $attributeGroups = $allAttributes->groupBy('attribute');
        return view('admin.product.attributes', compact('attributeGroups'));
    }
    //getProductAttributesValues
    public function getProductAttributesValues(Request $request)
    {
        $attribute = $request->attribute;
        $values = ProductVariantType::where('attribute', $attribute)->get('value');
        return view('admin.product.attribute-values', compact('values', 'attribute'));
    }
}
