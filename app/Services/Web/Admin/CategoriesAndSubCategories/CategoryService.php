<?php
namespace App\Services\Web\Admin\CategoriesAndSubCategories;

use App\Enums\StatusEnum;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

use App\Enums\MediaCollectionEnum;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CategoryService
{
    public function create(array $data): Category
    {
        return DB::transaction(function () use ($data) {
            $category = Category::create([
                'name' => $data['name'],
                 'description' => $data['description'],
                'status' => StatusEnum::ACTIVE->value,
            ]);

           if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $category
                    ->addMedia($data['image'])
                    ->toMediaCollection(MediaCollectionEnum::CATEGORY_IMAGE->value);

            }

            return $category;
        });
    }

    public function update(array $data, Category $category): Category
    {
        return DB::transaction(function () use ($data, $category) {
            $category->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'status' => $data['status'] ?? $category->status,
            ]);

            if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $category->clearMediaCollection(MediaCollectionEnum::CATEGORY_IMAGE->value);

                $category
                    ->addMedia($data['image'])
                     ->toMediaCollection(MediaCollectionEnum::CATEGORY_IMAGE->value);
            }

            return $category;
        });
    }

    public function delete(Category $category): void
    {
        DB::transaction(function () use ($category) {
            $category->clearMediaCollection(MediaCollectionEnum::CATEGORY_IMAGE->value);

            $category->delete();
        });
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

  public function getAll(Request $request)
{
    $query = Category::query();

    // فلترة الاسم إذا موجود
    if ($request->filled('name')) {
        $query->filterByName($request->input('name'));
    }

    // فلترة الحالة إذا موجودة
    if ($request->filled('status')) {
        $query->filterByStatus($request->input('status'));
    }

    return $query->latest()->get();
}

    public function show($id)
    {
        return Category::with('subCategories')->findOrFail($id);
    }
}
