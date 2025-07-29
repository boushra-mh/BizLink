<?php

namespace App\Http\Controllers\Web\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login'); // تأكد من وجود هذا الملف
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',      // حرف صغير
                'regex:/[A-Z]/',      // حرف كبير
                'regex:/[0-9]/',      // رقم
                'regex:/[@$!%*#?&]/', // رمز
            ],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('filament.pages.dashboard'));
            // أو: return redirect()->route('admin.dashboard'); إذا معرّف راوت خاص بلوحة الادمن
        }

        return back()
            ->withErrors(['email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
