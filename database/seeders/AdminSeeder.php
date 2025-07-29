<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::updateOrCreate(
            ['email' => 'admin@example.com'], // تأكد أن الإيميل فريد
            [
                'name' => 'Super Admin',
                'phone' => '0123456789',
                'password' => Hash::make('Password123!'), // كلمة مرور مشفرة
            ]
        );
    }
}
