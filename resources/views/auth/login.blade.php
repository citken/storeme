<!-- resources/views/auth/login.blade.php -->
@php
    use Illuminate\Support\Facades\Auth;

    if (Auth::check()) {
        $target = Auth::user()->role === 'admin'
            ? route('admin.dashboard')
            : route('user.dashboard');

        header("Location: " . $target);
        exit;
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - K-Host</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-2">Login K-Host</h2>
        <p class="text-center text-gray-500 mb-6">Masuk ke akun kamu</p>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">Email Address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    required
                    class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan email"
                >
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan password"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition"
            >
                Login
            </button>

            <a
                href="{{ route('register') }}"
                class="block text-center mt-4 text-blue-600 hover:underline"
            >
                Belum punya akun? Register
            </a>
        </form>
    </div>

</body>
</html>