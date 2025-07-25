@extends('layouts.admin.admin')

@section('title', __('messages.providers_pending'))

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">{{ __('messages.providers_pending') }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.status') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($providers as $provider)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $provider->name }}</td>
                    <td>{{ $provider->email }}</td>
                    <td>
                        @if ($provider->status === \App\Enums\StatusEnum::Pending)
                            <span class="badge bg-warning">{{ __('messages.pending') }}</span>
                        @elseif ($provider->status === \App\Enums\StatusEnum::Approved)
                            <span class="badge bg-success">{{ __('messages.approved') }}</span>
                        @else
                            <span class="badge bg-danger">{{ __('messages.rejected') }}</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.providers.approve', $provider->id) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">{{ __('messages.approve') }}</button>
                        </form>
                        <form method="POST" action="{{ route('admin.providers.reject', $provider->id) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">{{ __('messages.reject') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">{{ __('messages.no_providers_found') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
