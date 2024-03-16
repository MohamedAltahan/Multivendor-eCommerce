<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Variant;
use App\Models\VariantDetails;
use App\Models\SubCategory;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use fileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $product = new Product();
        $categories = Category::get();
        $brands = Brand::get();
        //used to connect the product with its images
        $product_key = uniqid();
        return view('admin.product.create', compact('categories', 'brands', 'product', 'product_key'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:200'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'price' => ['required', 'numeric'],
            'offer_price' => ['nullable', 'lt:price'],
            'quantity' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required']
        ]);
        $product = new Product();
        $productData = $request->except('image');
        // $productData['image'] = $this->fileUplaod($request, 'myDisk', 'product', 'image');
        $productData['product_key'] = $request->product_key;
        $productData['slug'] = Str::slug($request->name);
        $productData['vendor_id'] = Auth::user()->vendor->id;
        $productData['is_approved'] = 'yes';
        $product->create($productData);
        toastr('Created successfully');
        return redirect()->route('admin.products.index');
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
        $product = Product::findOrFail($id);
        $categories = Category::get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $brands = Brand::get();
        $productImages = ProductImages::where('product_key', $product->product_key)->get();
        return view('admin.product.edit', compact('product', 'categories', 'subCategories', 'childCategories', 'brands', 'productImages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'price' => ['required'],
            'offer_price' => ['nullable', 'lt:price'],
            'offer_start_date' => ['before:offer_end_date', 'nullable'],
            'offer_end_date' => ['after:offer_start_date', 'nullable'],
            'quantity' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required']
        ]);
        $product = Product::find($id);
        $productData = $request->except('image');

        if ($request->hasFile('image')) {
            $oldImagePath = $product->image;
            $productData['image'] = $this->fileUpdate($request, 'myDisk', 'product', 'image', $oldImagePath);
        }
        $productData['slug'] = Str::slug($request->name);
        $product->update($productData);
        toastr('Updated successfully');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if (OrderProduct::where('product_id', $product->id)->count() > 0) {
            return response(['status' => 'error', 'message' => 'This product has order, so you cannot delete it']);
        }
        //delete product images
        ProductImages::where('product_key', $product->product_key)->delete();
        //delete variant details
        $variants = VariantDetails::where('product_id', $product->id)->delete();
        //delete product itself
        $product->delete();
        return response(['status' => 'success', 'message' => 'Deleted successfully']);
    }
    // get sub categories using ajax ------------------------------------------------
    public function getchildCategories(Request $request)
    {
        return ChildCategory::where('sub_category_id', $request->id)->get();
    }
    //product image upload for dropzone request--------------------------------------
    public function uploadProductImages(Request $request, $id)
    {
        if ($request->hasFile('file')) {
            $imagePath = $this->fileUplaod($request, 'myDisk', 'prodctsGallery', 'file');
            $productImages = new ProductImages();
            $productImages['name'] = $imagePath;
            $productImages['product_key'] = $id;
            $productImages->save();

            return response($productImages->id);
        } else {
            return response(['e' => 'e']);
        }
    }
    //get Product Images using ajax---------------------------------------------------------
    public function getProductImages(Request $request)
    {
        $productImages = ProductImages::where('product_key', $request->product_key)->get();
        return view('admin.product.images', compact('productImages'));
    }

    //get Product Images using ajax---------------------------------------------------------
    public function deleteProductImage(Request $request)
    {
        $product_image = ProductImages::findOrFail($request->id);
        $product_image->delete();
        $this->deleteFile('myDisk', $product_image->name);
        $productImages = ProductImages::where('product_key', $request->product_key)->get();
        return view('admin.product.images', compact('productImages'));
    }

    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $request->status == "true" ? $product->status = 'active' : $product->status = 'inactive';
        $product->save();

        return response(['message' => 'Status has been updated']);
    }
}
