<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\Auth\LoginController;
 use App\Http\Controllers\Web\Customer\Auth\CustomerAuthController;
use Symfony\Component\Translation\Provider\ProviderInterface;

Route::get('/', function () {
    return view('welcome');
});



//     Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login.post');

// Route::middleware('auth:admin')->group(function () {
//     Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
//     // هنا ممكن تضيف باقي الراوتات للوحة الادمن اذا عندك، او تعتمد Filament للوحة
// });


Route::get('customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
Route::post('customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');


// استدعاء ملفات الروتس المفصولة
require __DIR__.'/admin/provider.php';
require __DIR__.'/admin/category.php';
require __DIR__.'/admin/sub_categories.php';
require __DIR__.'/admin/cities.php';
require __DIR__.'/admin/states.php';
require __DIR__.'/admin/tags.php';






