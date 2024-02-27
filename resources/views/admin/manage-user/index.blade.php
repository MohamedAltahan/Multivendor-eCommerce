@extends('admin.layouts.master')
@section('mainTitle', 'manage user')
@section('content')

    <div class="card-header">
        <h4>Create user</h4>
        <div class="card-header-action">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.manage-user.create') }}" method="POST">
            @csrf

            <div class="form-group">
                <x-form.input name="name" label="Name" class="form-control" />
            </div>

            <div class="form-group">
                <x-form.input name="email" label="Email" class="form-control" />
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.input type="password" name="password" label="Password" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-form.input type="password" name="password_confirmation" label="Confirm password"
                            class="form-control" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">Role</label>
                <select name="role" class="form-control">
                    <option value="">Select role</option>
                    <option value="user">user</option>
                    <option value="vendor">vendor</option>
                    <option value="admin">admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>

        </form>
    </div>

@endsection
