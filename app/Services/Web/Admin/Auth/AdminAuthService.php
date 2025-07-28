<?php
namespace App\Services\Web\Admin\Auth;

use Illuminate\Support\Facades\Auth;

class AdminAuthService
{
    public function login(array $credentials): bool
    {
        // استخدام الحارس الخاص بالادمن
        return Auth::guard('admin')->attempt($credentials);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
    }
}
