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
                            <h4>Edit slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.update', $slider->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <h5>Preview</h5>
                                    <img width="300px" src="{{ asset('uploads/' . $slider->banner_image) }}">
                                </div>

                                <div class="form-group">
                                    <x-form.input name="banner_image" label="Banner Image" type="file" accept="image/*"
                                        value={{ null }} class="form-control" />
                                </div>

                                <div class="form-group">
                                    <x-form.input value="{{ $slider->type }}" name="type" label="type"
                                        class="form-control" />
                                </div>
                                <div class="form-group">
                                    <x-form.input value="{!! $slider->title !!}" name="title" label="title"
                                        class="form-control" />
                                </div>
                                <div class="form-group">
                                    <x-form.input value="{{ $slider->starting_price }}" name="starting_price"
                                        label="starting price" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <x-form.input value="{{ $slider->banner_url }}" name="banner_url" label="Button URL"
                                        class="form-control" />
                                </div>

                                <div class="form-group">
                                    <x-form.input value="{{ $slider->serial }}" name="serial"
                                        label='order of Banner "1,2,3..."' class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="">status</label>
                                    <select name="status" id="inputStatus" class="form-control">
                                        <option {{ $slider->status == 'active' ? 'selected' : '' }} value="active">Active
                                        </option>
                                        <option {{ $slider->status == 'inactive' ? 'selected' : '' }} value="inactive">
                                            Inactive
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
