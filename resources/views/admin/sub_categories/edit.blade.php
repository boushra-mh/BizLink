@extends('layouts.admin.admin')

@section('title', __('Edit Subcategory'))

@section('content')
<div class="container mt-4">
    <h2>{{ __('Edit Subcategory') }}</h2>

    <form action="{{ route('admin.subcategories.update', $sub_category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name_en" class="form-label">{{ __('Name (EN)') }}</label>
            <input type="text" name="name[en]" class="form-control" value="{{ old('name.en', $sub_category->getTranslation('name', 'en')) }}">
            @error('name.en') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="name_ar" class="form-label">{{ __('Name (AR)') }}</label>
            <input type="text" name="name[ar]" class="form-control" value="{{ old('name.ar', $sub_category->getTranslation('name', 'ar')) }}">
            @error('name.ar') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">{{ __('Category') }}</label>
            <select name="category_id" class="form-control">
                <option value="">{{ __('Select Category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $sub_category->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->getTranslation('name', app()->getLocale()) }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </form>
</div>
@endsection
