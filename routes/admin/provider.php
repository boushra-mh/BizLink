<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\ServiceProvider\ProviderController;

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['web', 'auth:admin'])
    ->group(function () {

        // قائمة مزودي الخدمة - عرض فقط للمستخدمين بصلاحية view_providers
        Route::get('providers', [ProviderController::class, 'index'])
            ->name('providers.index')
            ->middleware('permission:view_providers');

        // عرض نموذج إنشاء مزود جديد - للمستخدمين بصلاحية add_provider
        Route::get('providers/create', [ProviderController::class, 'create'])
            ->name('providers.create')
            ->middleware('permission:add_provider');

        // حفظ مزود جديد - للمستخدمين بصلاحية save_provider
        Route::post('providers', [ProviderController::class, 'store'])
            ->name('providers.store')
            ->middleware('permission:save_provider');

        // عرض تفاصيل مزود خدمة - للمستخدمين بصلاحية view_provider_details
        Route::get('providers/{provider}', [ProviderController::class, 'show'])
            ->name('providers.show')
            ->middleware('permission:view_provider_details');

        // عرض نموذج تعديل مزود - للمستخدمين بصلاحية edit_provider
        Route::get('providers/{provider}/edit', [ProviderController::class, 'edit'])
            ->name('providers.edit')
            ->middleware('permission:edit_provider');

        // تحديث مزود - للمستخدمين بصلاحية save_provider
        Route::put('providers/{provider}', [ProviderController::class, 'update'])
            ->name('providers.update')
            ->middleware('permission:save_provider');

        // حذف مزود خدمة - مؤقتاً حطيتها على edit_provider إلا إذا أضفت صلاحية delete_provider
        Route::delete('providers/{provider}', [ProviderController::class, 'destroy'])
            ->name('providers.destroy')
            ->middleware('permission:edit_provider');

        // (اختياري) تعديل حالة المزود - يمكنك إنشاء صلاحية خاصة مثلاً update_provider_status
        // Route::patch('providers/{provider}/status', [ProviderController::class, 'updateStatus'])
        //     ->name('providers.updateStatus')
        //     ->middleware('permission:update_provider_status');
    });
