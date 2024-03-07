@extends('vendor.layouts.master')
@section('title')
    {{ $setting->site_name }} - Create withdraw request
@endsection
@section('content')
    <!--============================= DASHBOARD START  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Create withdraw request</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="row">
                                <div class="wsus__dash_pro_area col-md-5 my-1 mx-1">
                                    {{-- first form --------------------------------------- --}}
                                    <form action="{{ route('vendor.withdraw.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group my-1 my-2">
                                            <label for="">Method</label>
                                            <select name="method" id="method" class="form-control">
                                                <option value="">select method</option>
                                                @foreach ($withdrawMethods as $method)
                                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group my-2">
                                            <x-form.input label="Withdraw amount ({{ $setting->currency }})"
                                                name="withdraw_amount" />
                                        </div>

                                        <div class="form-group my-2">
                                            <label for="">Account information</label>
                                            <textarea name="account_info" class="form-control" rows="10"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary my-2">Submit</button>
                                    </form>

                                </div>
                                <div class="wsus__dash_pro_area account_info_area col-md-5 my-1 mx-1">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================= DASHBOARD end ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#method').on('change', function() {
                let id = $(this).val();
                $.ajax({
                    url: "{{ route('vendor.withdraw.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        $('.account_info_area').html(`
                    <h4>Payment range :  {{ $setting->currency }}${response.minimum_amount} - {{ $setting->currency }}${response.maximum_amount}</h4>
                    <h4>Withdraw charge: ${response.withdraw_charge}%</h4>
                    <p>${response.description}</p>`)
                    },
                    error: function(data) {

                    }
                })
            })
        })
    </script>
@endpush
