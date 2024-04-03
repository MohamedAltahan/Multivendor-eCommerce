@extends('admin.layouts.master')
@section('mainTitle', 'Advertisements')
@section('content')
    <div class="card-body">

        <div class="row">
            <div class="col-12 col-sm-12 col-md-2">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                        href="#list-home" role="tab">Home Banner 1</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                        href="#list-profile" role="tab">Home Banner 2</a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-10">
                <div class="tab-content" id="nav-tabContent">
                    @include('admin.advertisement.homepage-banner1')
                    @include('admin.advertisement.homepage-banner2')
                </div>
            </div>
        </div>
    </div>


@endsection
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
                        sectionName: 'doubleBanner',
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
