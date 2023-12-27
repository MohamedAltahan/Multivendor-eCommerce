@extends('admin.layouts.master')
@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create category</h4>
                            <div class="card-header-action">
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.category.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="">select icon</label>
                                    <div>
                                        <button name="icon" data-selected-class="btn-danger"
                                            data-unselected-class="btn-info" class="btn btn-primary"
                                            role="iconpicker"></button>
                                        @error('icon')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <x-form.input name="name" label="Name" class="form-control" />
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
