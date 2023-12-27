@extends('admin.layouts.master')
@section('mainTitle', 'Category')
@section('content')

    <div class="card-header">
        <h4>Edit category</h4>
        <div class="card-header-action">
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.child-category.update', $childCategory->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.child-category._form', ['buttonLabel' => 'Update'])
        </form>
    </div>

@endsection
