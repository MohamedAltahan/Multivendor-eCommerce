@extends('admin.layouts.master')
@section('mainTitle', 'Product')
@section('content')

    <div class="card-header">
        <h4>Create product</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <x-form.input name="image" label="Image" type="file" accept="image/*" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="name" label="Product name" value="{{ old('name', $product->name) }}"
                    label='Product name' class="form-control" />
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <x-form.input name="price" label="Price" value="{{ old('price', $product->price) }}"
                            class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <x-form.input name="offer_price" label="Offer price"
                            value="{{ old('offer_price', $product->offer_price) }}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <x-form.input name="offer_start_date" type='date' label="Offer start date"
                            value="{{ old('offer_start_date', $product->offer_start_date) }}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <x-form.input name="offer_end_date" type='date' label="Offer end data"
                            value="{{ old('offer_end_date', $product->offer_end_date) }}" class="form-control" />
                    </div>
                </div>
            </div>{{-- /row --}}

            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Product type</label>
                        <select name="product_type" class="form-control">
                            <option value="">Select</option>
                            <option @selected(old('product_type', $product->product_type) == 'new') value="new">New arrival</option>
                            <option @selected(old('product_type', $product->product_type) == 'featured') value="featured">Featured</option>
                            <option @selected(old('product_type', $product->product_type) == 'best') value="best">Best</option>
                            <option @selected(old('product_type', $product->product_type) == 'top') value="top">Top</option>
                        </select>
                    </div>
                </div>

            </div> {{-- /row  --}}

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" id="" class="form-control main-category">
                            <option value="">select</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Sub category</label>
                        <select name="sub_category_id" id="" class="form-control sub-category">
                            <option value="">select</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Child category</label>
                        <select name="child_category_id" id="" class="form-control child-category">
                            <option value="">select</option>
                        </select>
                    </div>
                </div>
            </div> {{-- /row --}}

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for=""> Brand</label>
                        <select name="brand_id" id="" class="form-control ">
                            <option value="">Select brand name</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(old('brand_id', $brand->id) == $product->brand_id)>{{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <x-form.input name="sku" label="SKU(Stock keeping Units)"
                            value="{{ old('sku', $product->sku) }}" class="form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <x-form.input name="quantity" min='0' type='number' label="Stock quantity"
                            value="{{ old('quantity', $product->quantity) }}" class="form-control" />
                    </div>
                </div>
            </div> {{-- /row --}}

            <div class="form-group">
                <x-form.input name="video_link" label="Video link" value="{{ old('video_link', $product->video_link) }}"
                    class="form-control" />
            </div>

            <div class="form-group">
                <label for="">Short description</label>
                <textarea name="short_description" class="form-control ">{{ old('short_description', $product->short_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="">Long description</label>
                <textarea name="long_description" type="text" class="form-control summernote">{{ old('long_description', $product->long_description) }}</textarea>
            </div>

            <div class="form-group">
                <x-form.input name="seo_title" label="SEO title" value="{{ old('seo_title', $product->seo_title) }}"
                    class="form-control" />
            </div>


            <div class="form-group">
                <label for="">SEO description</label>
                <textarea name="seo_description" type="text" class="form-control summernote">{{ old('seo_description', $product->seo_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="">Status</label>
                <select name="status" id="" class="form-control ">
                    <option value="active" @selected(old('status', $product->status) == 'active')>Active</option>
                    <option value="inactive" @selected(old('status', $product->status) == 'inactive')>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    {{-- scripts------------------------------------------------------------------------ --}}
    @push('scripts')
        <script>
            $(document).ready(function() {
                //get sub categories-----------------------------------------------------
                $('body').on('change', '.main-category', function(e) {
                    let id = $(this).val();
                    $.ajax({
                        method: 'GET',
                        url: '{{ route('admin.get-sub-categories') }}',
                        data: {
                            id
                        },
                        success: function(data) {
                            $('.sub-category').html(
                                `<option value="">Select sub category</option>`);
                            $('.child-category').html(
                                `<option value="">Select child category</option>`);
                            if (Object.entries(data).length === 0) {
                                $('.sub-category').append(
                                    `<option value="">No sub category</option>`
                                );
                            } else {
                                $.each(data, function(index, item) {
                                    $('.sub-category').append(
                                        `<option value="${item.id}">${item.name}</option>`
                                    );
                                })
                            }
                        },
                        error: function() {
                            alert("e");
                        }
                    })
                })
                //get child categories--------------------------------------------------
                $('body').on('change', '.sub-category', function(e) {
                    let id = $(this).val();
                    $.ajax({
                        method: 'GET',
                        url: '{{ route('admin.product.get-child-categories') }}',
                        data: {
                            id
                        },
                        success: function(data) {
                            $('.child-category').html(
                                `<option value="">Select child category</option>`);
                            if (Object.entries(data).length === 0) {
                                $('.child-category').append(
                                    `<option value="">No child category</option>`
                                );
                            } else {

                                $.each(data, function(index, item) {
                                    $('.child-category').append(
                                        `<option value="${item.id}">${item.name}</option>`
                                    );
                                })
                            }

                        },
                        error: function() {
                            alert("e");
                        }
                    })
                })
            })
        </script>
    @endpush
@endsection
