@extends('admin.layouts.master')
@section('mainTitle', 'Main Slider Banner')
@section('content')
    <div class="card-header">
        <h4>Main slider Banner</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">+ Create New</a>
        </div>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <label for="status" style="color: red">show (Main slider Banner) on the Home page:</label>
            </div>
            <div class="col-md-1 ">
                <label class="custom-switch ">
                    <input type="checkbox" name="status" id='status' class="custom-switch-input change-status"
                        {{ @$sectionStatus == 'active' ? 'checked' : '' }}>
                    <span class="custom-switch-indicator"></span>
                </label>
            </div>
        </div>


        {{ $dataTable->table() }}
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
@push('scripts')
    <script>
        // change status-------------------------------------------------------
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                $.ajax({
                    method: 'PUT',
                    url: "{{ route('admin.frontend-section.change-status') }}",
                    data: {
                        // status is the name of the value "ischecked" in you php function
                        status: isChecked,
                        sectionName: 'mainBanner',
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
