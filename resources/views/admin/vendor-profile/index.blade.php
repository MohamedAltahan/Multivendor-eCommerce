@extends('admin.layouts.master')
@section('mainTitle', 'Admin shop profile')
@section('content')
    <div class="card-header">
        <h4>Update admin's shop profile</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.vendor-profile.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="">Banner previvew</label>
                <br>
                <img width="150px" src="{{ asset('uploads/' . $profile->banner) }}" alt="">
            </div>
            <div class="form-group">
                <x-form.input name="banner" label="Banner Image" type="file" accept="image/*" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="shop_name" label="Shop name" value="{{ $profile->shop_name }}" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="phone" label="Phone" value="{{ $profile->phone }}" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="email" label="Email" value="{{ $profile->email }}" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="address" label="Address" value="{{ $profile->address }}" class="form-control" />
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea class="summernote" name="description" type='textarea' class="form-control">{{ $profile->description }}</textarea>
            </div>
            <div class="form-group">
                <x-form.input name="fb_link" label="Facebook link" value="{{ $profile->fb_link }}" class="form-control" />
            </div>
            <div class="form-group">
                <x-form.input name="insta_link" label="Istegram link" value="{{ $profile->insta_link }}"
                    class="form-control" />
            </div>
            <div class="form-group">
                <x-form.input name="tw_link" label="Twitter link" value="{{ $profile->tw_link }}" class="form-control" />
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    @push('scripts')
    @endpush
@endsection
