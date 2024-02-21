@extends('admin.layouts.master')
@section('mainTitle', 'Settings')
@section('content')
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                                href="#list-home" role="tab">Home Banner 1</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                                href="#list-profile" role="tab">Home Banner 2</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                                href="#list-messages" role="tab">Home Banner 3</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
                                href="#list-settings" role="tab">Home Banner 4</a>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="tab-content" id="nav-tabContent">
                            @include('admin.advertisement.homepage-banner1')
                            @include('admin.advertisement.homepage-banner2')
                            @include('admin.advertisement.homepage-banner3')
                            @include('admin.advertisement.homepage-banner4')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
