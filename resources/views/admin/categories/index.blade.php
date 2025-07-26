@extends('layouts.admin.admin')

@section('title', __('Categories'))

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">{{ __('Categories List') }}</h2>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> {{ __('Add Category') }}
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($category->getFirstMediaUrl('category_images'))
                            <img src="{{ $category->getFirstMediaUrl('category_images') }}" width="60">
                        @else
                            <span class="text-muted">{{ __('No image') }}</span>
                        @endif
                    </td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <span class="badge bg-success">{{ ucfirst($category->status) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline-block"
                              onsubmit="return confirm('{{ __('Are you sure?') }}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">{{ __('No categories found.') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
