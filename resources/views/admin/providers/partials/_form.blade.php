<div class="mb-3">
    <label>الاسم</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $provider->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>الوصف</label>
    <textarea name="description" class="form-control" required>{{ old('description', $provider->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>رقم الهاتف</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $provider->phone ?? '') }}">
</div>

<div class="mb-3">
    <label>واتساب</label>
    <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $provider->whatsapp ?? '') }}">
</div>

<div class="mb-3">
    <label>فيسبوك</label>
    <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $provider->facebook ?? '') }}">
</div>

<div class="mb-3">
    <label>انستغرام</label>
    <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $provider->instagram ?? '') }}">
</div>

<div class="mb-3">
    <label>الموقع</label>
    <input type="text" name="location" class="form-control" value="{{ old('location', $provider->location ?? '') }}">
</div>

<div class="mb-3">
    <label>التصنيف الفرعي</label>
    <select name="sub_category_id" class="form-control" required>
        <option value="">-- اختر --</option>
        @foreach($subCategories as $subCategory)
            <option value="{{ $subCategory->id }}" {{ old('sub_category_id', $provider->sub_category_id ?? '') == $subCategory->id ? 'selected' : '' }}>
                {{ $subCategory->name }}
            </option>
        @endforeach
    </select>
</div>
