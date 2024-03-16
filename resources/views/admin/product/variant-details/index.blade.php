@extends('admin.layouts.master')
@section('mainTitle', 'variant details')
@section('content')
    <div class="card-header">
        <h4> variant values for : <span style="color: royalblue">{{ $variant->name }}</span> </h4>
        <div class="card-header-action ">
            <a href="{{ route('admin.product.variant-details.create', ['variantId' => $variant->id]) }}"
                class="btn btn-primary">+Create New</a>
        </div>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            // change status-------------------------------------------------------
            $(document).ready(function() {
                $('body').on('click', '.change-status', function() {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('admin.product.variant-details.change-status') }}",
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
