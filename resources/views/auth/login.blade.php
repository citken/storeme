<!-- resources/views/auth/login.blade.php -->
@php
    use Illuminate\Support\Facades\Auth;

    // Kalau sudah login langsung redirect
    if(Auth::check()) {
        header("Location: " . route('dashboard'));
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

    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass {
            backdrop-filter: blur(15px);
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <div class="glass w-full max-w-md rounded-3xl p-8 shadow-2xl text-white">

        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold tracking-wide">
                K-Host
            </h1>

            <p class="text-gray-200 mt-2 text-sm">
                Login untuk masuk ke dashboard hosting
            </p>
        </div>

        <!-- Error -->
        @if($errors->any())
            <div class="bg-red-500/20 border border-red-400 text-red-100 px-4 py-3 rounded-xl mb-5">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-5">
                <label class="block mb-2 text-sm font-semibold">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    required
                    placeholder="Masukkan email..."
                    class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 placeholder:text-gray-300 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-semibold">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    placeholder="Masukkan password..."
                    class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 placeholder:text-gray-300 text-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
            </div>

            <!-- Button Login -->
            <button
                type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 transition duration-300 text-white font-bold py-3 rounded-xl shadow-lg"
            >
                Login Sekarang
            </button>

            <!-- Register -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-200">
                    Belum punya akun?
                </p>

                <a
                    href="{{ route('register') }}"
                    class="inline-block mt-3 px-5 py-2 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 transition"
                >
                    ➜ Daftar / Register
                </a>
            </div>
        </form>

    </div>

</body>
</html>