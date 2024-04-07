@extends('admin.layouts.master')
@section('mainTitle', 'vendor requests')
@section('content')

    <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <td>User Name: </td>
                                    <td>{{ $vendor->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>User Email: </td>
                                    <td>{{ $vendor->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Shop Name: </td>
                                    <td>{{ $vendor->shop_name }}</td>
                                </tr>
                                <tr>
                                    <td>Shop Email: </td>
                                    <td>{{ $vendor->email }}</td>

                                </tr>
                                <tr>
                                    <td>Shop Phone: </td>
                                    <td>{{ $vendor->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Shop Address: </td>
                                    <td>{{ $vendor->address }}</td>
                                </tr>
                                <tr>
                                    <td>Description: </td>
                                    <td>{{ $vendor->description }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-8">
                                <div class="col-md-4">
                                    <form action="{{ route('admin.vendor-requests.change-status', $vendor->id) }} "
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="">Action</label>
                                            <select name="status" class="form-control">
                                                <option @selected($vendor->status == 'pending') value="pending">
                                                    Pending</option>
                                                <option @selected($vendor->status == 'active') value="active">
                                                    Approve</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary"> Update</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#order_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.order.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message)
                        }
                    },
                    error: function(data) {
                        alert(data);
                    }
                })
            })

            $('#payment_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.payment.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message)
                        }
                    },
                    error: function(data) {
                        alert(data);
                    }
                })
            })

            $('.print_invoice').on('click', function() {
                let printBody = $('.invoice-print');
                let originalContents = $('body').html();

                $('body').html(printBody.html());

                window.print();

                $('body').html(originalContents);

            })
        })
    </script>
@endpush
