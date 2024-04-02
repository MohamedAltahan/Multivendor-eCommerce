@extends('admin.layouts.master')
@section('mainTitle', 'Home page setting')
@section('content')

    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list"
                        href="#list-profile" role="tab">Populay category section</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                        href="#list-messages" role="tab"> products slider one</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
                        href="#list-settings" role="tab">products slider two</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
                        href="#list-slider-three" role="tab">products slider three</a>
                    <a class="list-group-item list-group-item-action" href="{{ route('admin.slider.index') }}">Main large
                        slider </a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-9">
                <div class="tab-content" id="nav-tabContent">
                    @include('admin.home-page-setting.sections.popular-category')
                    @include('admin.home-page-setting.sections.product-slider-one')
                    @include('admin.home-page-setting.sections.product-slider-two')
                    @include('admin.home-page-setting.sections.product-slider-three')
                </div>
            </div>
        </div>
    </div>




@endsection
