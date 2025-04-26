@extends('layouts.admin.app')


@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manage Attributes</h1>
        <a href="{{ route('admin.attributes.categories.create') }}" class="btn btn-primary">Add New Category</a>
    </div>

    @foreach($categories as $category)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $category->name }}</h5>
                <div>
                    <a href="{{ route('admin.attributes.create', $category) }}" class="btn btn-sm btn-success">Add Attribute</a>
                    <a href="{{ route('admin.attributes.categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit Category</a>
                    <form class="d-inline" action="{{ route('admin.attributes.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure? This will delete all attributes in this category!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete Category</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->attributes as $attribute)
                            <tr>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->description }}</td>
                                <td>
                                    @if($attribute->active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.attributes.edit', $attribute) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form class="d-inline" action="{{ route('admin.attributes.destroy', $attribute) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($category->attributes->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No attributes found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    @if($categories->isEmpty())
        <div class="alert alert-info">
            No attribute categories found. <a href="{{ route('admin.attributes.categories.create') }}">Create your first category</a>.
        </div>
    @endif
</div>
@endsection
