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
                        <h4> variants details for : <span style="color: royalblue;font-size:25px">{{ $product->name }}</span>
                        </h4>
                        <br>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.product-variant.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Chose Variant</label>
                                                <select name="product_variant_type_id" class="form-select variant-type">
                                                    <option value="">select</option>
                                                    @foreach ($variantTypes as $variant)
                                                        <option value="{{ $variant->id }}" @selected(old('product_variant_type_id') == $variant->id)>
                                                            {{ $variant->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Chose variant value</label>
                                                <select name="product_variant_detail_id" id=""
                                                    class="form-select variant-details">
                                                    <option value="">select</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <x-form.input label="Variant price ({{ $setting->currency }}) (if exist)"
                                                    name="variant_price" value="0" />
                                            </div>
                                        </div>
                                    </div> {{-- /row --}}
                                    <div class="row my-1">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">status</label>
                                                <select name="status" id="inputStatus" class="form-select">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 30px"> Add
                                        </button>
                                    </div>

                                </form>
                                <br>
                                <hr>
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- scripts========================================================================================= --}}
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            $(document).ready(function() {
                //get variant details==========================================================
                $('body').on('change', '.variant-type', function(e) {
                    let id = $(this).val();
                    $.ajax({
                        method: 'GET',
                        url: '{{ route('vendor.get-variant-details') }}',
                        data: {
                            id
                        },
                        success: function(data) {
                            $('.variant-details').html(
                                `<option value="">Select a value</option>`);
                            if (Object.values(data).length === 0) {
                                $('.variant-details').append(
                                    `<option value="">No values</option>`
                                );
                            } else {
                                $.each(data, function(index, item) {
                                    $('.variant-details').append(
                                        `<option value="${item.id}">${item.variant_value}</option>`
                                    );
                                })
                            }
                        },
                        error: function() {
                            alert("Error");
                        }
                    })
                })

                // change status==========================================================
                $('body').on('click', '.change-status', function() {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('vendor.variant-details.change-status') }}",
                        data: {
                            // status is the name of the value "ischecked" in you php function
                            status: isChecked,
                            id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            toastr.success(data.message)
                        },
                        error: function(error) {
                            toastr.error('Not updated')
                        }


                    })
                })
            })
        </script>
    @endpush
@endsection
