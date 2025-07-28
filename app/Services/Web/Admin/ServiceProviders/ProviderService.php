<?php
namespace App\Services\Web\Admin\ServiceProviders;

use App\Models\Provider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ProviderService
{
    public function getAll(array $filters = [])
    {
        $query = Provider::with(['subCategory.category', 'city.state', 'tags']);

        $query = $this->applyFilters($query, $filters);

        if (!empty($filters['sort_by']) && $filters['sort_by'] === 'views') {
            $query->orderByDesc('views');
        } else {
            $query->orderByDesc('created_at');
        }

        return $query->get();
    }

    public function getById(int $id): Provider
    {
        $provider = Provider::with(['subCategory.category', 'city.state', 'tags'])->findOrFail($id);

        if (!Auth::check() || Auth::id() !== $provider->user_id) {
            $provider->increment('views');
        }

        return $provider;
    }

    public function create(array $data): Provider
    {
        return DB::transaction(function () use ($data) {
            // إنشاء المزود مع الأعمدة الأساسية مع sub_category_id و city_id
            $provider = Provider::create(Arr::except($data, ['image', 'gallery', 'tag_ids']));

            // مزود مرتبط بتاجات كثيرة many-to-many
            if (!empty($data['tag_ids'])) {
                $provider->tags()->sync($data['tag_ids']);
            }

            // رفع الصور
            if (!empty($data['image'])) {
                $provider->addMedia($data['image'])->toMediaCollection('provider_image');
            }

            if (!empty($data['gallery']) && is_array($data['gallery'])) {
                foreach ($data['gallery'] as $image) {
                    $provider->addMedia($image)->toMediaCollection('provider_gallery');
                }
            }

            return $provider;
        });
    }

    public function update(array $data, Provider $provider): Provider
    {
        return DB::transaction(function () use ($data, $provider) {
            $provider->update(Arr::except($data, ['image', 'gallery', 'tag_ids']));

            if (isset($data['tag_ids'])) {
                $provider->tags()->sync($data['tag_ids']);
            }

            if (isset($data['image'])) {
                $provider->clearMediaCollection('provider_image');
                $provider->addMedia($data['image'])->toMediaCollection('provider_image');
            }

            if (isset($data['gallery']) && is_array($data['gallery'])) {
                $provider->clearMediaCollection('provider_gallery');
                foreach ($data['gallery'] as $image) {
                    $provider->addMedia($image)->toMediaCollection('provider_gallery');
                }
            }

            return $provider;
        });
    }

    public function delete(Provider $provider): void
    {
        DB::transaction(function () use ($provider) {
            $provider->clearMediaCollection('provider_image');
            $provider->clearMediaCollection('provider_gallery');
            $provider->delete();
        });
    }

    protected function applyFilters($query, array $filters)
    {
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['category'])) {
            $query->whereHas('subCategory.category', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['category'] . '%');
            });
        }

        if (!empty($filters['sub_category'])) {
            $query->whereHas('subCategory', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['sub_category'] . '%');
            });
        }

        if (!empty($filters['state'])) {
            $query->whereHas('city.state', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['state'] . '%');
            });
        }

        if (!empty($filters['city'])) {
            $query->whereHas('city', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['city'] . '%');
            });
        }

        if (!empty($filters['tags'])) {
            $query->whereHas('tags', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['tags'] . '%');
            });
        }

        return $query;
    }
}
