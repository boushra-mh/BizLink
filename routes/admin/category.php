,<?php
use App\Http\Controllers\Web\Admin\CategoriesAndSubCategories\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['web', 'auth:admin'])
    ->group(function () {

        // قائمة الأصناف - عرض فقط للمستخدمين بصلاحية view_categories
        Route::get('categories', [CategoryController::class, 'index'])
            ->name('categories.index')
            ->middleware('permission:view_categories');

        // عرض نموذج إنشاء صنف جديد - للمستخدمين بصلاحية add_category
        Route::get('categories/create', [CategoryController::class, 'create'])
            ->name('categories.create')
            ->middleware('permission:add_category');

        // حفظ صنف جديد - للمستخدمين بصلاحية save_category
        Route::post('categories', [CategoryController::class, 'store'])
            ->name('categories.store')
            ->middleware('permission:save_category');

        // عرض تفاصيل صنف - للمستخدمين بصلاحية view_category_details
        Route::get('categories/{category}', [CategoryController::class, 'show'])
            ->name('categories.show')
            ->middleware('permission:view_category_details');

        // عرض نموذج تعديل صنف - للمستخدمين بصلاحية edit_category
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('categories.edit')
            ->middleware('permission:edit_category');

        // تحديث صنف - للمستخدمين بصلاحية save_category (عادة هذه صلاحية الحفظ سواء إنشاء أو تعديل)
        Route::put('categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update')
            ->middleware('permission:save_category');

        // حذف صنف - يمكنك تحديد صلاحية خاصة إن أردت (مثلاً 'delete_category')، لكن حالياً لا توجد في القائمة
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy')
            ->middleware('permission:edit_category'); // أو تضع صلاحية خاصة بالحذف لو لديك
    });
