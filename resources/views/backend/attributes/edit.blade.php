@extends('layouts.admin.app')


@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Attribute: {{ $attribute->name }}</h5>
        </div>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
        <div class="card-body">
            <form action="{{ route('admin.attributes.update', $attribute) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $attribute->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $attribute->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $attribute->sort_order) }}">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if($attribute->category->slug == 'age-range')
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0">Age Range Metadata</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="min_months" class="form-label">Minimum Age (in months)</label>
                            <input type="number" class="form-control" id="min_months" name="meta_data[min_months]" value="{{ old('meta_data.min_months', $attribute->meta_data['min_months'] ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="max_months" class="form-label">Maximum Age (in months, leave empty for unlimited)</label>
                            <input type="number" class="form-control" id="max_months" name="meta_data[max_months]" value="{{ old('meta_data.max_months', $attribute->meta_data['max_months'] ?? '') }}">
                        </div>
                    </div>
                </div>
                @endif

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="active" name="active" {{ old('active', $attribute->active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Active</label>
                </div>

                <button type="submit" class="btn btn-primary">Update Attribute</button>
                <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
