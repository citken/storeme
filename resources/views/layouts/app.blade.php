<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Host Dashboard</title>
    <!-- Tailwind CSS (CDN for fast prototyping) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">
    
    <!-- Global Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-extrabold text-blue-700 tracking-tight">K-Host Panel</span>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-gray-700 font-medium">Halo, {{ Auth::user()->name }}</span>
                        <!-- Form Logout Aman (Method POST + CSRF) -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-red-600 transition shadow-sm">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Global Success Alert -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm rounded-r" role="alert">
                    <p class="font-bold">Berhasil</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Global Error Alert -->
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 shadow-sm rounded-r" role="alert">
                    <p class="font-bold">Perhatian</p>
                    <ul class="list-disc pl-5 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Dynamic Content Injected Here -->
            @yield('content')
            
        </div>
    </main>

</body>
</html>