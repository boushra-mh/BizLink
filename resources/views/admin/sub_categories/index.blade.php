@extends('layouts.admin.admin')

@section('title', __('Subcategories List'))

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ __('Subcategories') }}</h2>
        @can('add_subcategory')
        <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> {{ __('Add Subcategory') }}
        </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Name (EN)') }}</th>
                <th>{{ __('Name (AR)') }}</th>
                <th>{{ __('Category') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sub_categories as $sub_category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sub_category->getTranslation('name', 'en') }}</td>
                    <td>{{ $sub_category->getTranslation('name', 'ar') }}</td>
                    <td>{{ $sub_category->category?->getTranslation('name', app()->getLocale()) }}</td>
                    <td>
                        @can('edit_subcategory')
                        <a href="{{ route('admin.subcategories.edit', $sub_category->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan

                        @can('delete_subcategory')
                        <form action="{{ route('admin.subcategories.destroy', $sub_category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
