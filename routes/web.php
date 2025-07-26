<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Translation\Provider\ProviderInterface;

Route::get('/', function () {
    return view('welcome');
});
// استدعاء ملفات الروتس المفصولة
require __DIR__.'/admin/provider.php';
require __DIR__.'/admin/category.php';
require __DIR__.'/admin/sub_categories.php';
require __DIR__.'/admin/cities.php';
require __DIR__.'/admin/states.php';
require __DIR__.'/admin/tags.php';






