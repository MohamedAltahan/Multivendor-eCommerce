@extends('vendor.layouts.master')
@section('title')
    {{ $setting->site_name }} - Product
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Create product</h3>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{-- used to append product photos after upload them using ajax --}}
                                <div id="product_images"></div>

                                <form class="dropzone mb-3" method="POST" id='myDropzone' enctype="multipart/form-data"
                                    action="{{ route('vendor.product.upload.images', $product_key) }}">
                                    @csrf
                                </form>

                                <form id="main-form" action="{{ route('vendor.products.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <x-form.input name='product_key' type='hidden' value='{{ $product_key }}' />
                                    <div class="form-group">
                                        <x-form.input name="name" label="Product name"
                                            value="{{ old('name', $product->name) }}" label='Product name'
                                            class="form-control" />
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <x-form.input name="price" label="Price"
                                                    value="{{ old('price', $product->price) }}" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <x-form.input name="offer_price" label="Offer price"
                                                    value="{{ old('offer_price', $product->offer_price) }}"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <x-form.input name="offer_start_date" type='date'
                                                    label="Offer start date"
                                                    value="{{ old('offer_start_date', $product->offer_start_date) }}"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <x-form.input name="offer_end_date" type='date' label="Offer end data"
                                                    value="{{ old('offer_end_date', $product->offer_end_date) }}"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
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

                                    </div>{{-- /row --}}

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Category</label>
                                                <select name="category_id" id=""
                                                    class="form-control main-category">
                                                    <option value="">select</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Sub category</label>
                                                <select name="sub_category_id" id=""
                                                    class="form-control sub-category">
                                                    <option value="">select</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Child category</label>
                                                <select name="child_category_id" id=""
                                                    class="form-control child-category">
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
                                                        <option value="{{ $brand->id }}" @selected(old('brand_id', $brand->id) == $product->brand_id)>
                                                            {{ $brand->name }}
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
                                                <x-form.input name="quantity" min='0' type='number'
                                                    label="Stock quantity"
                                                    value="{{ old('quantity', $product->quantity) }}"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div> {{-- /row --}}

                                    <div class="form-group">
                                        <x-form.input name="video_link" label="Video link"
                                            value="{{ old('video_link', $product->video_link) }}" class="form-control" />
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
                                        <x-form.input name="seo_title" label="SEO title"
                                            value="{{ old('seo_title', $product->seo_title) }}" class="form-control" />
                                    </div>


                                    <div class="form-group">
                                        <label for="">SEO description</label>
                                        <textarea name="seo_description" type="text" class="form-control summernote">{{ old('seo_description', $product->seo_description) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Product Status</label>
                                        <select name="status" id="" class="form-control ">
                                            <option value="active" @selected(old('status', $product->status) == 'active')>Active</option>
                                            <option value="inactive" @selected(old('status', $product->status) == 'inactive')>Inactive</option>
                                        </select>
                                    </div>
                                </form>
                                <button type="submit" form="main-form" class="btn btn-primary">Create</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================================================ --}}
    {{-- push styles---------------------------------------------------------------------- --}}
    @push('styles')
        <link rel="stylesheet" href="{{ asset('backend/assets/css/dropzone.min.css') }}">
    @endpush
    {{-- push scripts----------------------------------------------------------------------- --}}
    @push('scripts')
        {{-- dropZone scripts--------------------------- --}}
        <script src="{{ asset('backend/assets/js/dropzone.min.js') }}"></script>

        <script>
            Dropzone.options.myDropzone = {

                paramName: "file", // The name that will be used to transfer the file (by default is 'file')
                maxFilesize: 10, // MB
                acceptedFiles: 'image/*',
                addRemoveLinks: true, //to add remove or cance buttons
                //------------------------------------------------------
                //if true the files will be upload once you chose it automatically'defaul:true'
                //when you are ready to submit simply call myDropzone.processQueue().
                // autoProcessQueue: false,
                //-------------------------------------------------------
                maxFiles: 20, //max number of uploaded files per product
                //uploadMultiple: true, //upload all the file in one request or more it depends on 'parallelUploads' 'default:false'
                parallelUploads: 20,
                thumbnailWidth: 120, //default thumbnail width 120
                thumbnailHeight: 120, //default thumbnail hieght 120
                //----------------force rezise image---------------------------
                resizeWidth: 200, //it cares about aspect when it resize ^_^
                resizeHeight: null,
                resizeQuality: 0.8, //defaul is 0.8 (from the original quality)
                //-------------------------------------------------------------

                init: function() {

                    // var submitButton = document.querySelector("#submit-all")

                    // if (autoProcessQueue: false)you well need this button to start upload manualy
                    // submitButton.addEventListener("click", function() {
                    //     myDropzone.processQueue(); // Tell Dropzone to process all queued files.
                    // });

                    // after each photo upload check state if the queue
                    this.on("success", function() {
                        //if all files have been uploaded
                        if (this.getUploadingFiles().length == 0) {
                            $.ajax({
                                method: 'GET',
                                url: '{{ route('vendor.product.get-product-images') }}',
                                data: {
                                    product_key: '{{ $product_key }}'
                                },
                                success: function(data) {
                                    $('#product_images').html(data);
                                },
                                error: function() {
                                    alert('wait a while');
                                }
                            })
                        }
                    });
                    // after upload all file clear drop box
                    this.on("complete", function() {
                        this.removeAllFiles();
                    });


                }
            };
        </script>
        {{-- delete image by ajax--------------------------------------------------------/ --}}
        <script>
            $('body').on('click', '.delete-image', function(e) {
                e.preventDefault();
                //disable all delete buttons until the next request
                $('.delete-image').prop('disabled', true);
                $.ajax({
                    method: 'DELETE',
                    url: "{{ route('vendor.product.delete-product-image') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $(this).attr('id'),
                        product_key: '{{ $product_key }}',
                    },
                    success: function(data) {
                        $('#product_images').html(data);
                    },
                    error: function() {
                        alert('Error');
                    }
                })
            });
        </script>



        {{-- other scripts==================================================================== --}}
        <script>
            //get sub categories-----------------------------------------------------
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('vendor.get-sub-categories') }}',
                    data: {
                        id
                    },
                    success: function(data) {
                        $('.sub-category').html(
                            `<option value="">Select sub category</option>`);
                        $('.child-category').html(
                            `<option value="">Select child category</option>`);
                        if (Object.values(data).length === 0) {
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
                        alert("Error");
                    }
                })
            })
            //get child categories--------------------------------------------------
            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('vendor.product.get-child-categories') }}',
                    data: {
                        id
                    },
                    success: function(data) {
                        // clear field before add new data
                        $('.child-category').html(
                            `<option value="">Select child category</option>`);
                        if (Object.values(data).length === 0) {
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
                        alert("Error");
                    }
                })
            })
        </script>
    @endpush
@endsection
