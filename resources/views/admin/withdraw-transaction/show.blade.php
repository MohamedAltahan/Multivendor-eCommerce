@extends('admin.layouts.master')
@section('mainTitle', 'vendor request')
@section('content')

    <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>Withdraw method</b></td>
                                    <td>{{ $request->method }}</td>
                                </tr>
                                <tr>
                                    <td><b>Date</b></td>
                                    <td>{{ date('d M Y , H:m', strtotime($request->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Total requested amount </b></td>
                                    <td>{{ $setting->currency }} {{ $request->total_amount }}</td>
                                </tr>
                                <tr>
                                    <td><b>Withdraw charge </b></td>
                                    <td>{{ $setting->currency }} {{ $request->withdraw_charge }}</td>
                                </tr>
                                <tr>
                                    <td><b> Net withdraw amount </b></td>
                                    <td>{{ $setting->currency }} {{ $request->withdraw_amount }}</td>
                                </tr>
                                <tr>
                                    <td><b> Status </b></td>
                                    <td>
                                        @if ($request->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($request->status == 'paid')
                                            <span class="badge badge-success">Paid</span>
                                        @else
                                            <span class="badge badge-danger">Canceled</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Account information </b></td>
                                    <td>{{ $request->account_info }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="col-md-6">
                            <form action="{{ route('admin.withdraw-transaction.update', $request->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="">
                                        <option @selected($request->status === 'pending') value="pending">Pending</option>
                                        <option @selected($request->status === 'paid') value="paid">Paid</option>
                                        <option @selected($request->status === 'declined') value="declined">Declined</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    </section>
@endsection

@push('scripts')
@endpush
