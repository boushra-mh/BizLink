@extends('layouts.admin.admin')

@section('title', __('Service Provider Details'))

@section('content')
<div class="container py-4">
    <h2>{{ $provider->name }}</h2>

    <div class="row mb-3">
        <div class="col-md-6">
            <strong>{{ __('Shop Name:') }}</strong> {{ $provider->shop_name }}
        </div>
        <div class="col-md-6">
            <strong>{{ __('Category:') }}</strong> {{ $provider->category->name ?? '-' }}
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <strong>{{ __('Subcategory:') }}</strong> {{ $provider->subcategory->name ?? '-' }}
        </div>
        <div class="col-md-6">
            <strong>{{ __('State:') }}</strong> {{ $provider->state->name ?? '-' }}
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <strong>{{ __('City:') }}</strong> {{ $provider->city->name ?? '-' }}
        </div>
        <div class="col-md-6">
            <strong>{{ __('Views:') }}</strong> {{ $provider->views_count ?? 0 }}
        </div>
    </div>

    <div class="mb-3">
        @if($provider->image)
            <img src="{{ asset('storage/' . $provider->image) }}" alt="Shop Image" class="img-fluid mb-3" style="max-height: 300px;">
        @endif
        @if($provider->gallery && $provider->gallery->count())
            <div class="mb-3">
                <h5>{{ __('Gallery') }}</h5>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($provider->gallery as $image)
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Gallery Image" style="max-height: 150px;">
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <div class="mb-3">
        <h5>{{ __('Description') }}</h5>
        <p>{{ $provider->description }}</p>
    </div>

    <div class="mb-3">
        <h5>{{ __('Contacts') }}</h5>
        <ul>
            <li><strong>{{ __('Phone:') }}</strong> <a href="tel:{{ $provider->phone }}">{{ $provider->phone }}</a></li>
            @if($provider->whatsapp)
                <li><strong>{{ __('WhatsApp:') }}</strong> <a href="https://wa.me/{{ $provider->whatsapp }}" target="_blank">{{ $provider->whatsapp }}</a></li>
            @endif
            @if($provider->facebook)
                <li><strong>{{ __('Facebook:') }}</strong> <a href="{{ $provider->facebook }}" target="_blank">{{ __('Visit Page') }}</a></li>
            @endif
            @if($provider->instagram)
                <li><strong>{{ __('Instagram:') }}</strong> <a href="{{ $provider->instagram }}" target="_blank">{{ __('Visit Page') }}</a></li>
            @endif
        </ul>
    </div>

    <div class="mb-3">
        <h5>{{ __('Tags') }}</h5>
        @foreach($provider->tags as $tag)
            <span class="badge bg-info text-dark">{{ $tag->name }}</span>
        @endforeach
    </div>

    <div class="mb-3">
        <h5>{{ __('Offers') }}</h5>
        @if($provider->offers && $provider->offers->count())
            <div class="row">
                @foreach($provider->offers as $offer)
                    <div class="col-md-3 mb-3">
                        @if($offer->image)
                            <img src="{{ asset('storage/' . $offer->image) }}" alt="Offer Image" class="img-fluid">
                        @endif
                        <div>
                            <span class="badge 
                                @if($offer->status == 'active') bg-success
                                @elseif($offer->status == 'inactive') bg-secondary
                                @else bg-danger
                                @endif
                            ">
                                {{ ucfirst($offer->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>{{ __('No offers available.') }}</p>
        @endif
    </div>

    <div class="mb-3">
        <strong>{{ __('Start Date:') }}</strong> {{ $provider->start_date->format('Y-m-d') }}<br>
        <strong>{{ __('End Date:') }}</strong> {{ $provider->end_date->format('Y-m-d') }}<br>
        <strong>{{ __('Status:') }}</strong> {{ ucfirst($provider->status) }}
    </div>

    <a href="{{ route('admin.providers.index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    <a href="{{ route('admin.providers.edit', $provider->id) }}" class="btn btn-primary">{{ __('Edit Provider') }}</a>
</div>
@endsection
