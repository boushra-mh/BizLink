<?php
namespace App\Services\Web\Admin\CategoriesAndSubCategories;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CategoryService
{
    public function create(array $data): Category
    {
        return DB::transaction(function () use ($data) {
            $category = Category::create([
                'name' => $data['name'],
                 'description' => $data['description'],
                'status' => $data['status'],
            ]);

           if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $category
                    ->addMedia($data['image'])
                    ->toMediaCollection('category_images');
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
                'status' => $data['status'],
            ]);

            if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $category->clearMediaCollection('category_images');

                $category
                    ->addMedia($data['image'])
                    ->toMediaCollection('category_images');
            }

            return $category;
        });
    }

    public function delete(Category $category): void
    {
        DB::transaction(function () use ($category) {
            // حذف الصور المرتبطة
            $category->clearMediaCollection('category_images');

            // حذف السجل
            $category->delete();
        });
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    public function getAll()
    {
        return Category::latest()->get();
    }

    public function show($id)
    {
        return $this->getCategoryById($id);
    }
}
