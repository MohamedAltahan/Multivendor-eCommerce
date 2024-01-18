@extends('vendor.layouts.master')
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Create variant</h3>
                        <a href="{{ route('vendor.products.index', ['product_id' => $variant->product_id]) }}"
                            class="btn btn-warning my-4">Back</a>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                <form action="{{ route('vendor.product-variant.update', $variant->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <x-form.input name="name" label="Name" class="form-control"
                                            value="{{ $variant->name }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="">status</label>
                                        <select name="status" id="inputStatus" class="form-control">
                                            <option @selected($variant->status == 'active') value="active">Active</option>
                                            <option @selected($variant->status == 'inactive') value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary my-3">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================= DASHBOARD end ==============================-->
@endsection
