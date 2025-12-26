<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WebTrack</title>
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    <style>
        body {
            background-color: var(--background-color);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 2rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2 class="text-center font-bold" style="margin-bottom: 0.5rem; color: var(--primary-color);">WebTrack</h2>
        <p class="text-center text-muted mb-4">Masuk untuk melanjutkan</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-full justify-between" style="justify-content: center;">
                Login
            </button>
        </form>
        
        <div class="mt-4 text-center text-sm text-muted">
            <p>Gunakan akun demo: <strong>admin@example.com</strong> / <strong>password</strong></p>
        </div>
    </div>
</body>
</html>
