<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\CategoriesAndSubCategories\SubCategoryController;

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['web', 'auth:admin'])
    ->group(function () {

        // عرض كل الأقسام الفرعية
        Route::get('subcategories', [SubCategoryController::class, 'index'])
            ->name('subcategories.index')
            ->middleware('permission:view_subcategories');

        // عرض نموذج إنشاء قسم فرعي
        Route::get('subcategories/create', [SubCategoryController::class, 'create'])
            ->name('subcategories.create')
            ->middleware('permission:add_subcategory');

        // حفظ القسم الفرعي الجديد
        Route::post('subcategories', [SubCategoryController::class, 'store'])
            ->name('subcategories.store')
            ->middleware('permission:save_subcategory');

        // عرض نموذج التعديل
        Route::get('subcategories/{subcategory}/edit', [SubCategoryController::class, 'edit'])
            ->name('subcategories.edit')
            ->middleware('permission:edit_subcategory');

        // تحديث القسم الفرعي
        Route::put('subcategories/{subcategory}', [SubCategoryController::class, 'update'])
            ->name('subcategories.update')
            ->middleware('permission:save_subcategory');

        // حذف القسم الفرعي
        Route::delete('subcategories/{subcategory}', [SubCategoryController::class, 'destroy'])
            ->name('subcategories.destroy')
            ->middleware('permission:delete_subcategory');
    });
