@extends('layouts.admin.admin')

@section('title', __('Edit Service Provider'))

@section('content')
<div class="container py-4">
    <h2>{{ __('Edit Service Provider') }}</h2>

    <form action="{{ route('admin.providers.update', $provider->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        {{-- نفس الحقول كما في create.blade.php مع استبدال القيم بـ $provider->... --}}

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Provider Name') }} <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name', $provider->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">{{ __('Category') }} <span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" 
                class="form-select @error('category_id') is-invalid @enderror" required>
                <option value="">{{ __('Select Category') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $provider->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Subcategory --}}
        <div class="mb-3">
            <label for="sub_category_id" class="form-label">{{ __('Subcategory') }} <span class="text-danger">*</span></label>
            <select name="sub_category_id" id="sub_category_id" 
                class="form-select @error('sub_category_id') is-invalid @enderror" required>
                <option value="">{{ __('Select Subcategory') }}</option>
                {{-- يمكن ملء هذا بناءً على $provider->category_id --}}
            </select>
            @error('sub_category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Shop Name --}}
        <div class="mb-3">
            <label for="shop_name" class="form-label">{{ __('Shop Name') }} <span class="text-danger">*</span></label>
            <input type="text" name="shop_name" id="shop_name" 
                class="form-control @error('shop_name') is-invalid @enderror" 
                value="{{ old('shop_name', $provider->shop_name) }}" required>
            @error('shop_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Image (single) --}}
        <div class="mb-3">
            <label for="image" class="form-label">{{ __('Shop Image') }}</label>
            @if($provider->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $provider->image) }}" alt="Current Image" style="max-width: 150px;">
                </div>
            @endif
            <input type="file" name="image" id="image" accept="image/*" 
                class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Gallery (multiple images) --}}
        <div class="mb-3">
            <label for="gallery" class="form-label">{{ __('Shop Gallery') }}</label>
            {{-- يمكن إضافة عرض صور معرض الصور الحالي إن أردت --}}
            <input type="file" name="gallery[]" id="gallery" multiple accept="image/*" 
                class="form-control @error('gallery') is-invalid @enderror">
            @error('gallery')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
            <textarea name="description" id="description" rows="4" 
                class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $provider->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- State --}}
        <div class="mb-3">
            <label for="state_id" class="form-label">{{ __('State') }} <span class="text-danger">*</span></label>
            <select name="state_id" id="state_id" 
                class="form-select @error('state_id') is-invalid @enderror" required>
                <option value="">{{ __('Select State') }}</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}" @selected(old('state_id', $provider->state_id) == $state->id)>{{ $state->name }}</option>
                @endforeach
            </select>
            @error('state_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- City --}}
        <div class="mb-3">
            <label for="city_id" class="form-label">{{ __('City') }} <span class="text-danger">*</span></label>
            <select name="city_id" id="city_id" 
                class="form-select @error('city_id') is-invalid @enderror" required>
                <option value="">{{ __('Select City') }}</option>
                {{-- يمكنك ملء المدن حسب $provider->state_id --}}
            </select>
            @error('city_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Contacts --}}
        <div class="mb-3">
            <label for="phone" class="form-label">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
            <input type="tel" name="phone" id="phone" maxlength="10"
                class="form-control @error('phone') is-invalid @enderror" 
                value="{{ old('phone', $provider->phone) }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="whatsapp" class="form-label">{{ __('WhatsApp Number') }}</label>
            <input type="tel" name="whatsapp" id="whatsapp" maxlength="10"
                class="form-control @error('whatsapp') is-invalid @enderror" 
                value="{{ old('whatsapp', $provider->whatsapp) }}">
            @error('whatsapp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="facebook" class="form-label">{{ __('Facebook Page Link') }}</label>
            <input type="url" name="facebook" id="facebook" 
                class="form-control @error('facebook') is-invalid @enderror" 
                value="{{ old('facebook', $provider->facebook) }}">
            @error('facebook')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="instagram" class="form-label">{{ __('Instagram Page Link') }}</label>
            <input type="url" name="instagram" id="instagram" 
                class="form-control @error('instagram') is-invalid @enderror" 
                value="{{ old('instagram', $provider->instagram) }}">
            @error('instagram')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tags (multi-select) --}}
        <div class="mb-3">
            <label for="tags" class="form-label">{{ __('Tags') }} <span class="text-danger">*</span></label>
            <select name="tags[]" id="tags" multiple
                class="form-select @error('tags') is-invalid @enderror" required>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', $provider->tags->pluck('id')->toArray())))>{{ $tag->name }}</option>
                @endforeach
            </select>
            @error('tags')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Start Date --}}
        <div class="mb-3">
            <label for="start_date" class="form-label">{{ __('Start Date') }} <span class="text-danger">*</span></label>
            <input type="date" name="start_date" id="start_date"
                class="form-control @error('start_date') is-invalid @enderror"
                value="{{ old('start_date', $provider->start_date->format('Y-m-d')) }}" required>
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- End Date --}}
        <div class="mb-3">
            <label for="end_date" class="form-label">{{ __('End Date') }} <span class="text-danger">*</span></label>
            <input type="date" name="end_date" id="end_date"
                class="form-control @error('end_date') is-invalid @enderror"
                value="{{ old('end_date', $provider->end_date->format('Y-m-d')) }}" required>
            @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">{{ __('Update Provider') }}</button>
            <a href="{{ route('admin.providers.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
        </div>

    </form>
</div>

@push('scripts')
<script>
    // نفس السكربت الخاص بـ dependent selects كما في create
</script>
@endpush

@endsection
