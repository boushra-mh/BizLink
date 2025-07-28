<?php
namespace App\Services\Web\Admin\CategoriesAndSubCategories;

use App\Enums\StatusEnum;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;


class SubCategoryService
{
    public function getSubCategoryById($id)
    {
        return SubCategory::findOrFail($id);
    }

    public function getAll(Request $request)
    {
          $query = SubCategory::query();

        $query->filterByName($request->input('name'))
              ->filterByStatus($request->input('status'))
              ->filterByRelation('category', 'id', $request->input('category_id'));
        return SubCategory::latest()->get();
    }

    public function create(array $data)
    {
       return DB::transaction(function () use ($data) {
            $sub_category = SubCategory::create([
         'name' => $data['name'],
                'description' =>$data['description'],
                'status' =>StatusEnum::ACTIVE->value,
                   'category_id' => $data['category_id'],
            ]);

          
            if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $sub_category
                    ->addMedia($data['image'])
                    ->toMediaCollection('sub_category_images');
            }
           

            return $sub_category;
        });
    }
        public function update(array $data, SubCategory $sub_category): SubCategory
    {
        return DB::transaction(function () use ($data, $sub_category) {
            $sub_category->update([
                'name' => $data['name'],
                'description' =>$data['description'],
                'status' =>StatusEnum::ACTIVE->value,
                   'category_id' => $data['category_id'],
            ]);

          if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $sub_category->clearMediaCollection('sub_category_images');

                $sub_category
                    ->addMedia($data['image'])
                    ->toMediaCollection('sub_category_images');
            }

            return $sub_category;
        });
    }
    public function show($id)
    {
        return $this->getSubCategoryById($id);
    }
    public function delete(SubCategory $sub_category)
    {
         DB::transaction(function () use ($sub_category) {
            // حذف الصور المرتبطة
            $sub_category->clearMediaCollection('sub_category_images');

            // حذف السجل
            $sub_category->delete();
        });
    }
}