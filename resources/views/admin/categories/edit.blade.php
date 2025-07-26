@extends('layouts.admin.admin')

@section('title', __('Edit Category'))

@section('content')
<div class="container mt-4">
    <h2>{{ __('Edit Category') }}</h2>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            <textarea class="form-control" name="description">{{ old('description', $category->description) }}</textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">{{ __('Image') }}</label><br>
            @if($category->getFirstMediaUrl('category_images'))
                <img src="{{ $category->getFirstMediaUrl('category_images') }}" width="80" class="mb-2">
            @endif
            <input type="file" class="form-control" name="image">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
    </form>
</div>
@endsection
