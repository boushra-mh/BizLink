@extends('layouts.admin.admin')

@section('title', __('Category Details'))

@section('content')
<div class="container mt-4">
    <h2>{{ __('Category Details') }}</h2>

    <div class="card mt-3 p-4">
        @if($category->getFirstMediaUrl('category_images'))
            <img src="{{ $category->getFirstMediaUrl('category_images') }}" width="100" class="mb-3">
        @endif

        <h4>{{ $category->name }}</h4>
        <p>{{ $category->description }}</p>
        <span class="badge bg-success">{{ ucfirst($category->status) }}</span>
    </div>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-3">{{ __('Back to list') }}</a>
</div>
@endsection
