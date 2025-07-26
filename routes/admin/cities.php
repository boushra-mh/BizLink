<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\CitiesAndStates\CityController;

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['web', 'auth:admin'])
    ->group(function () {

        Route::get('cities', [CityController::class, 'index'])
            ->name('cities.index')
            ->middleware('permission:view_cities');

        Route::get('cities/create', [CityController::class, 'create'])
            ->name('cities.create')
            ->middleware('permission:add_city');

        Route::post('cities', [CityController::class, 'store'])
            ->name('cities.store')
            ->middleware('permission:save_city');

        Route::get('cities/{city}', [CityController::class, 'show'])
            ->name('cities.show')
            ->middleware('permission:view_city_details');

        Route::get('cities/{city}/edit', [CityController::class, 'edit'])
            ->name('cities.edit')
            ->middleware('permission:edit_city');

        Route::put('cities/{city}', [CityController::class, 'update'])
            ->name('cities.update')
            ->middleware('permission:save_city');

        Route::delete('cities/{city}', [CityController::class, 'destroy'])
            ->name('cities.destroy')
            ->middleware('permission:delete_city');
    });
