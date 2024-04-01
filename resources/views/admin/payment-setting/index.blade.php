@extends('admin.layouts.master')
@section('mainTitle', 'Payment')
@section('content')


    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-messages-list" data-toggle="list"
                        href="#list-messages" role="tab">COD (cash on delivery)</a>
                    <a class="list-group-item list-group-item-action " id="list-home-list" data-toggle="list"
                        href="#list-home" role="tab">Paypal</a>
                    <a class="list-group-item list-group-item-action" id="list-stripe-list" data-toggle="list"
                        href="#list-stripe" role="tab">Stripe</a>
                    {{-- <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
                                href="#list-settings" role="tab">Settings</a> --}}
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-9">
                <div class="tab-content" id="nav-tabContent">
                    @include('admin.payment-setting.sections.paypal-setting')
                    @include('admin.payment-setting.sections.stripe-setting')
                    @include('admin.payment-setting.sections.cod-setting')
                    {{--
                            <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                aria-labelledby="list-settings-list">
                                Lorem ipsum culpa in ad velit dolore anim labore incididunt do aliqua sit veniam commodo
                                elit dolore do labore occaecat laborum sed quis proident fugiat sunt pariatur. Cupidatat ut
                                fugiat anim ut dolore excepteur ut voluptate dolore excepteur mollit commodo.
                            </div> --}}

                </div>
            </div>
        </div>
    </div>



@endsection
