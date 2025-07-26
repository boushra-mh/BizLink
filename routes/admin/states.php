<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\CitiesAndStates\StateController;

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['web', 'auth:admin'])
    ->group(function () {

        Route::get('states', [StateController::class, 'index'])
            ->name('states.index')
            ->middleware('permission:view_states');

        Route::get('states/create', [StateController::class, 'create'])
            ->name('states.create')
            ->middleware('permission:add_state');

        Route::post('states', [StateController::class, 'store'])
            ->name('states.store')
            ->middleware('permission:save_state');

        Route::get('states/{state}', [StateController::class, 'show'])
            ->name('states.show')
            ->middleware('permission:view_state_details');

        Route::get('states/{state}/edit', [StateController::class, 'edit'])
            ->name('states.edit')
            ->middleware('permission:edit_state');

        Route::put('states/{state}', [StateController::class, 'update'])
            ->name('states.update')
            ->middleware('permission:save_state');

        Route::delete('states/{state}', [StateController::class, 'destroy'])
            ->name('states.destroy')
            ->middleware('permission:delete_state');
    });
