@extends('layouts.admin.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <h5 class="card-header">Edit Brand</h5>
    <div class="card-body">
        <form method="post" action="{{route('brand.update',$brand->id)}}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{$brand->title}}" class="form-control">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active" {{(($brand->status=='active') ? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($brand->status=='inactive') ? 'selected' : '')}}>Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
@endpush
