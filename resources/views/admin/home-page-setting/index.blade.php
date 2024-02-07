@extends('admin.layouts.master')
@section('mainTitle', 'Home page setting')
@section('content')
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list"
                                href="#list-profile" role="tab">Populay category section</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                                href="#list-messages" role="tab">Messages</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
                                href="#list-settings" role="tab">Settings</a>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="tab-content" id="nav-tabContent">
                            @include('admin.home-page-setting.sections.popular-category')
                            <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                aria-labelledby="list-messages-list">
                                In quis non esse eiusmod sunt fugiat magna pariatur officia anim ex officia nostrud amet
                                nisi pariatur eu est id ut exercitation ex ad reprehenderit dolore nostrud sit ut culpa
                                consequat magna ad labore proident ad qui et tempor exercitation in aute veniam et velit
                                dolore irure qui ex magna ex culpa enim anim ea mollit consequat ullamco exercitation in.
                            </div>
                            <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                aria-labelledby="list-settings-list">
                                Lorem ipsum culpa in ad velit dolore anim labore incididunt do aliqua sit veniam commodo
                                elit dolore do labore occaecat laborum sed quis proident fugiat sunt pariatur. Cupidatat ut
                                fugiat anim ut dolore excepteur ut voluptate dolore excepteur mollit commodo.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
