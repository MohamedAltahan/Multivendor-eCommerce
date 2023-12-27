@extends('admin.layouts.master')
@section('mainTitle', 'Category')
@section('content')
    <div class="card-header">
        <h4>All child categories</h4>
        <div class="card-header-action">
            <a href="{{ route('admin.child-category.create') }}" class="btn btn-primary">+ Create New</a>
        </div>
    </div>
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>

    {{-- scripts ----------------------------------------------------------- --}}
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script>
            $(document).ready(function() {

                // change status --------------------------------------------------------------
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
                        url: "{{ route('admin.child-category.change-status') }}",
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
