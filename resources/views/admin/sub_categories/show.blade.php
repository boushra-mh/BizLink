@extends('layouts.admin.admin')

@section('title', __('messages.subcategory_details'))

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('messages.subcategory_details') }}</h2>
        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">
            {{ __('messages.back_to_list') }}
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">{{ __('messages.subcategory_information') }}</h4>

            <table class="table table-bordered">
                <tr>
                    <th>{{ __('messages.id') }}</th>
                    <td>{{ $sub_category->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.name_en') }}</th>
                    <td>{{ $sub_category->getTranslation('name', 'en') }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.name_ar') }}</th>
                    <td>{{ $sub_category->getTranslation('name', 'ar') }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.category') }}</th>
                    <td>{{ $sub_category->category?->name ?? __('messages.not_found') }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.created_at') }}</th>
                    <td>{{ $sub_category->created_at?->format('Y-m-d H:i') }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.updated_at') }}</th>
                    <td>{{ $sub_category->updated_at?->format('Y-m-d H:i') }}</td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('admin.subcategories.edit', $sub_category->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                </a>
                <form action="{{ route('admin.subcategories.destroy', $sub_category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
