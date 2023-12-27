@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <x-form.input name="banner_image" label="Banner Image" type="file" accept="image/*"
                                        class="form-control" />
                                </div>

                                <div class="form-group">
                                    <x-form.input name="type" label="type" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <x-form.input name="title" label="title" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <x-form.input name="starting_price" label="starting price" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <x-form.input name="banner_url" label="Button URL" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <x-form.input name="serial" label='order of Banner "1,2,3..."' class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="">status</label>
                                    <select name="status" id="inputStatus" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
