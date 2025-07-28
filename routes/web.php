<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\Auth\AdminAuthController;
use Symfony\Component\Translation\Provider\ProviderInterface;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout')->middleware('auth:admin');
});

// استدعاء ملفات الروتس المفصولة
require __DIR__.'/admin/provider.php';
require __DIR__.'/admin/category.php';
require __DIR__.'/admin/sub_categories.php';
require __DIR__.'/admin/cities.php';
require __DIR__.'/admin/states.php';
require __DIR__.'/admin/tags.php';






