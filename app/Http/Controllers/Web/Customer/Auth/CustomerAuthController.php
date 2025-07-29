<?php

namespace App\Http\Controllers\Web\Customer\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CustomerAuthController extends Controller
{
    // عرض صفحة تسجيل الدخول للزبون
    public function showLoginForm()
    {
        return view('customer.auth.login');
    }

    // تنفيذ عملية تسجيل الدخول
    public function login(Request $request)
    {
        // تحقق من البيانات المدخلة
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // محاولة تسجيل الدخول باستخدام guard الزبون
        if (Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            // إعادة تعيين جلسة المستخدم لتجنب هجمات Session Fixation
            $request->session()->regenerate();

            // إعادة التوجيه إلى لوحة تحكم الزبون
            return redirect()->intended(route('customer.dashboard'));
        }

        // فشل تسجيل الدخول - رفع خطأ مع رسالة مناسبة
        throw ValidationException::withMessages([
            'email' => __('auth.failed'), // رسالة مترجمة مسبقاً في ملف الترجمة
        ]);
    }

    // تسجيل خروج الزبون
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('customer.login'));
    }
}
