@extends('layouts.admin.admin') {{-- تأكد يكون عندك لياوت الادمن هذا أو بديل مشابه --}}

@section('title', __('Service Providers List'))

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{ __('Service Providers') }}</h2>
        <a href="{{ route('admin.providers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> {{ __('Add New Provider') }}
        </a>
    </div>

    {{-- فلتر البحث --}}
    <form method="GET" action="{{ route('admin.providers.index') }}" class="mb-4">
        <div class="row g-3">

            <div class="col-md-3">
                <input type="text" name="search_name" value="{{ request('search_name') }}" class="form-control" placeholder="{{ __('Search by Provider Name') }}">
            </div>

            <div class="col-md-3">
                <input type="text" name="search_shop" value="{{ request('search_shop') }}" class="form-control" placeholder="{{ __('Search by Shop Name') }}">
            </div>

            <div class="col-md-2">
                <select name="category" class="form-select">
                    <option value="">{{ __('All Categories') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">{{ __('All Statuses') }}</option>
                    <option value="active" @selected(request('status') == 'active')>{{ __('Active') }}</option>
                    <option value="inactive" @selected(request('status') == 'inactive')>{{ __('Inactive') }}</option>
                    <option value="expired" @selected(request('status') == 'expired')>{{ __('Expired') }}</option>
                </select>
            </div>

            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-outline-primary">{{ __('Filter') }}</button>
            </div>
        </div>
    </form>

    {{-- جدول العرض --}}
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('Provider Name') }}</th>
                    <th>{{ __('Shop Name') }}</th>
                    <th>{{ __('Thumbnail') }}</th>
                    <th>{{ __('Tags') }}</th>
                    <th>{{ __('Views') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($providers as $provider)
                <tr>
                    <td>{{ $provider->name }}</td>
                    <td>{{ $provider->shop_name ?? '-' }}</td>
                    <td>
                        @if($provider->image)
                            <img src="{{ asset('storage/' . $provider->image) }}" alt="{{ $provider->shop_name }}" class="img-thumbnail" style="max-width: 80px;">
                        @else
                            <span class="text-muted">{{ __('No Image') }}</span>
                        @endif
                    </td>
                    <td>
                        @foreach($provider->tags as $tag)
                            <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>{{ $provider->views_count ?? 0 }}</td>
                    <td>
                        @php
                            $statusClass = match ($provider->status) {
                                'active' => 'badge bg-success',
                                'inactive' => 'badge bg-secondary',
                                'expired' => 'badge bg-danger',
                                default => 'badge bg-light text-dark'
                            };
                        @endphp
                        <span class="{{ $statusClass }}">
                            {{ ucfirst($provider->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.providers.edit', $provider->id) }}" class="btn btn-sm btn-warning" title="{{ __('Edit') }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        {{-- زر حذف إذا تريد تضيفه لاحقاً --}}
                        <form action="{{ route('admin.providers.destroy', $provider->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('Are you sure you want to delete this provider?') }}');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="{{ __('Delete') }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">{{ __('No Providers found.') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination إذا متوفر --}}
    <div class="d-flex justify-content-center">
        {{ $providers->links() }}
    </div>
</div>
@endsection
