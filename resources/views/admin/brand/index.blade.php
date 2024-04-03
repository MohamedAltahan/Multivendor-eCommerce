@extends('admin.layouts.master')
@section('mainTitle', 'Brand')
@section('content')

    <div class="card-header">
        <h4>All Brands</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.brand.create') }}" class="btn btn-primary">+ Create New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label for="status1" style="color: red">show (brand slider) on Home
                    page:</label>
            </div>
            <div class="col-md-1 ">
                <label class="custom-switch ">
                    <input type="checkbox" name="status" id='status1' class="custom-switch-input brand-change-status"
                        {{ @$sectionStatus == 'active' ? 'checked' : '' }}>
                    <span class="custom-switch-indicator"></span>
                </label>
            </div>
            <hr>
        </div>
        <h7>Notes:</h7>
        <h7 style="color: red ;display:block"> featured brads -> will appear on Home page slider </h7>
        <h7 style="color: red"> status -> will make it appear when (add product)</h7>
        <hr>
        {{ $dataTable->table() }}
    </div>

    {{-- scripts--------------------------------------------------------------------- --}}
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            $(document).ready(function() {
                $('body').on('click', '.change-status', function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('admin.brand.change-status') }}",
                        data: {
                            // status is the name of the value "ischecked" in you php function
                            status: isChecked,
                            id,
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
@push('scripts')
    <script>
        // change status-------------------------------------------------------
        $(document).ready(function() {
            $('body').on('click', '.brand-change-status', function() {
                let isChecked = $(this).is(':checked');
                $.ajax({
                    method: 'PUT',
                    url: "{{ route('admin.frontend-section.change-status') }}",
                    data: {
                        // status is the name of the value "ischecked" in you php function
                        status: isChecked,
                        sectionName: 'brandSlider',
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
