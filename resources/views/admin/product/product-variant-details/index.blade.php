@extends('admin.layouts.master')
@section('mainTitle', 'Product variants details')
@section('content')
    <div class="card-header">
        <h5> variants details for : <span style="color: royalblue">{{ $product->name }}</span> </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.product-variant.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Chose Variant</label>
                        <select name="product_variant_type_id" class="form-control variant-type">
                            <option value="">select</option>
                            @foreach ($variantTypes as $variant)
                                <option value="{{ $variant->id }}" @selected(old('category_id') == $variant->id)>{{ $variant->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Chose variant value</label>
                        <select name="product_variant_detail_id" id="" class="form-control variant-details">
                            <option value="">select</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <x-form.input label="Variant price ({{ $setting->currency }}) (if exist)" name="variant_price"
                            value="0" />
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px"> Add </button>
                </div>
            </div> {{-- /row --}}

        </form>
        <br>
        <hr>
        {{ $dataTable->table() }}
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            //get sub categories-----------------------------------------------------
            $('body').on('change', '.variant-type', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('admin.get-variant-details') }}',
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
        </script>
    @endpush
@endsection
