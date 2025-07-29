<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <title>تسجيل دخول الإدارة</title>
</head>
<body>
    <h1>تسجيل دخول الإدارة</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf

        <label for="email">البريد الإلكتروني:</label><br />
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus /><br />

        <label for="password">كلمة المرور:</label><br />
        <input type="password" id="password" name="password" required /><br />

        <label>
            <input type="checkbox" name="remember" />
            تذكرني
        </label><br />

        <button type="submit">تسجيل الدخول</button>
    </form>
</body>
</html>
