<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - K-Host</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen py-10">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-slate-900">Buat Akun K-Host</h2>
            <p class="text-sm text-gray-500 mt-2">Daftar sekarang untuk mengelola Cloud & K-CBT Anda.</p>
        </div>
        
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r">
                <ul class="list-disc pl-4 text-sm font-medium">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-slate-700 text-sm font-bold mb-2" for="name">Nama Lengkap</label>
                <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" id="name" type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
            </div>

            <div>
                <label class="block text-slate-700 text-sm font-bold mb-2" for="email">Alamat Email</label>
                <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
            </div>

            <div>
                <label class="block text-slate-700 text-sm font-bold mb-2" for="whatsapp">No. WhatsApp</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg font-bold">
                        +62
                    </span>
                    <input class="w-full px-4 py-2 border border-gray-300 rounded-r-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" id="whatsapp" type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="81234567890" required>
                </div>
            </div>

            <div>
                <label class="block text-slate-700 text-sm font-bold mb-2" for="password">Password</label>
                <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" id="password" type="password" name="password" required>
            </div>

            <div>
                <label class="block text-slate-700 text-sm font-bold mb-2" for="password_confirmation">Konfirmasi Password</label>
                <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <div class="pt-4">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition-all transform hover:-translate-y-0.5" type="submit">
                    Daftar Sekarang
                </button>
            </div>
        </form>

        <p class="text-center text-sm text-gray-600 mt-8">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Masuk di sini</a>
        </p>
    </div>
</body>
</html>