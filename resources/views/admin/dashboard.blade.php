@extends('layouts.app')

@section('content')

@php
    // LOGIKA CERDAS K-PROJECTS: Memisahkan Data CBT dan Reguler secara Real-time
    $cbtCategories = $categories->filter(fn($c) => str_contains(strtolower($c->name), 'cbt'));
    $regCategories = $categories->filter(fn($c) => !str_contains(strtolower($c->name), 'cbt'));
    
    $cbtProducts = $products->where('is_cbt_panel', true);
    $regProducts = $products->where('is_cbt_panel', false);

    // K-AI FIX: Kalkulasi Statistik Cepat untuk Dashboard
    $pendingOrdersCount = $orders->where('status', 'pending')->count() + $orders->where('status', 'processing')->count();
    $pendingDepositsCount = $deposits->where('status', 'Pending')->count() + $deposits->where('status', 'Validating')->count();
@endphp

<!-- HEADER & STATS -->
<div class="mb-10">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Admin Control Panel</h1>
            <p class="text-slate-500 font-medium mt-1">Pusat Kendali Infrastruktur Terpisah: K-CBT Premium & Cloud Reguler.</p>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Layanan Aktif</p>
                <h4 class="text-3xl font-black text-slate-800 mt-1">{{ $products->count() }} <span class="text-sm font-semibold text-slate-400">Paket</span></h4>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl shadow-inner">📦</div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pesanan Pending/Proses</p>
                <h4 class="text-3xl font-black text-orange-600 mt-1">{{ $pendingOrdersCount }} <span class="text-sm font-semibold text-orange-400">Antrean</span></h4>
            </div>
            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center text-xl shadow-inner">🛒</div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Deposit Menunggu Validasi</p>
                <h4 class="text-3xl font-black text-indigo-600 mt-1">{{ $pendingDepositsCount }} <span class="text-sm font-semibold text-indigo-400">Trx</span></h4>
            </div>
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center text-xl shadow-inner">💳</div>
        </div>
    </div>
</div>

<!-- ========================================================== -->
<!-- ZONA 1: MANAJEMEN K-CBT PREMIUM                            -->
<!-- ========================================================== -->
<div class="mb-14">
    <div class="flex items-center mb-6">
        <div class="bg-gradient-to-br from-orange-500 to-rose-600 w-12 h-12 rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/30 mr-4">
            <span class="text-white text-xl">🚀</span>
        </div>
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Zona Manajemen K-CBT</h2>
            <p class="text-xs font-bold text-orange-600 uppercase tracking-wider">Eksklusif Premium Panel</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        
        <!-- Kategori CBT -->
        <div class="bg-white rounded-[2rem] shadow-[0_5px_20px_-5px_rgba(249,115,22,0.1)] border border-orange-100 overflow-hidden flex flex-col">
            <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-black text-slate-800 text-lg">📁 Kategori K-CBT</h3>
                <span class="text-[10px] font-black bg-orange-100 text-orange-700 px-3 py-1 rounded-full tracking-widest">GLOBAL FEATURES</span>
            </div>
            
            <div class="p-6 bg-slate-50/50 border-b border-slate-100">
                <form action="{{ route('admin.category.store') }}" method="POST" class="flex flex-col md:flex-row gap-3">
                    @csrf
                    <input type="hidden" name="sort_order" value="1">
                    <input type="text" name="name" placeholder="Nama Kategori (Wajib isi 'CBT')" class="w-full md:w-1/3 bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm" required>
                    <div class="w-full md:w-2/3 flex gap-2">
                        <input type="text" name="description" placeholder="Fitur Global (Pisahkan dgn Titik)..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all shadow-sm" required>
                        <button type="submit" class="bg-slate-900 text-white font-black px-5 py-2.5 rounded-xl hover:bg-orange-600 transition-colors shadow-md shrink-0">+</button>
                    </div>
                </form>
            </div>

            <div class="p-0 overflow-y-auto max-h-[350px] flex-1">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-slate-100">
                        @forelse($cbtCategories as $category)
                        <tr class="hover:bg-orange-50/40 transition-colors group">
                            <td class="p-6">
                                <form action="{{ route('admin.category.update', $category->id) }}" method="POST" class="flex flex-col lg:flex-row gap-3">
                                    @csrf @method('PUT')
                                    <input type="text" name="name" value="{{ $category->name }}" class="bg-transparent border border-slate-200 group-hover:border-orange-300 rounded-lg px-3 py-2 w-full lg:w-1/3 text-sm font-black text-slate-800 focus:ring-2 focus:ring-orange-500 outline-none" required>
                                    <textarea name="description" rows="1" class="bg-transparent border border-slate-200 group-hover:border-orange-300 rounded-lg px-3 py-2 w-full lg:w-2/3 text-xs text-slate-600 focus:ring-2 focus:ring-orange-500 outline-none" required>{{ $category->description }}</textarea>
                                    <button type="submit" class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg text-xs font-bold hover:bg-orange-500 hover:text-white transition-all shadow-sm">Simpan</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td class="p-10 text-center"><div class="text-4xl mb-2">📭</div><div class="text-sm font-bold text-slate-400">Belum ada Kategori K-CBT.</div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paket CBT -->
        <div class="bg-white rounded-[2rem] shadow-[0_5px_20px_-5px_rgba(249,115,22,0.1)] border border-orange-100 overflow-hidden flex flex-col">
            <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-black text-slate-800 text-lg">💻 Varian Paket K-CBT</h3>
                <span class="text-[10px] font-black bg-orange-100 text-orange-700 px-3 py-1 rounded-full tracking-widest">HARDWARE SPECS</span>
            </div>
            
            <div class="p-6 bg-slate-50/50 border-b border-slate-100">
                <form action="{{ route('admin.product.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="hidden" name="is_cbt_panel" value="1"> 
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <select name="category_id" class="bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-orange-500 outline-none shadow-sm" required>
                            <option value="">Pilih Kategori CBT</option>
                            @foreach($cbtCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="name" placeholder="Nama Paket (Starter/Pro)" class="bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-orange-500 outline-none shadow-sm" required>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">Rp</span>
                            <input type="number" name="price" placeholder="Harga/Thn" class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm font-black text-blue-700 focus:ring-2 focus:ring-orange-500 outline-none shadow-sm" required>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-3">
                        <input type="text" name="description" placeholder="Spek (Pisahkan dgn Koma: 100 User, 2GB RAM)" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:ring-2 focus:ring-orange-500 outline-none shadow-sm" required>
                        <button type="submit" class="bg-gradient-to-r from-orange-500 to-rose-600 text-white font-black px-6 py-2.5 rounded-xl shadow-[0_5px_15px_rgba(249,115,22,0.4)] hover:shadow-[0_8px_20px_rgba(249,115,22,0.6)] hover:-translate-y-0.5 transition-all shrink-0">
                            + PAKET CBT
                        </button>
                    </div>
                </form>
            </div>

            <div class="p-0 overflow-y-auto max-h-[350px] flex-1">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-slate-100">
                        @forelse($cbtProducts as $product)
                        <tr class="hover:bg-orange-50/40 transition-colors group">
                            <td class="p-6">
                                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" class="space-y-3">
                                    @csrf @method('PUT')
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                                        <div class="col-span-4">
                                            <label class="text-[10px] text-slate-400 font-bold uppercase mb-1 block">Nama Paket</label>
                                            <input type="text" name="name" value="{{ $product->name }}" class="bg-transparent border border-slate-200 group-hover:border-orange-300 rounded-lg px-3 py-2 w-full text-sm font-black text-slate-800 focus:ring-2 focus:ring-orange-500 outline-none" required>
                                        </div>
                                        <div class="col-span-5 relative">
                                            <label class="text-[10px] text-slate-400 font-bold uppercase mb-1 block">Harga (Rp)</label>
                                            <input type="number" name="price" value="{{ $product->price }}" class="bg-transparent border border-slate-200 group-hover:border-orange-300 rounded-lg px-3 py-2 w-full text-sm font-mono font-bold text-slate-700 focus:ring-2 focus:ring-orange-500 outline-none" required>
                                        </div>
                                        <div class="col-span-3">
                                            <label class="text-[10px] text-slate-400 font-bold uppercase mb-1 block">Diskon (%)</label>
                                            <input type="number" name="discount_percent" value="{{ $product->discount_percent }}" class="bg-transparent border border-slate-200 group-hover:border-orange-300 rounded-lg px-3 py-2 w-full text-sm text-center font-bold text-rose-500 focus:ring-2 focus:ring-orange-500 outline-none">
                                        </div>
                                    </div>
                                    <div class="flex gap-3 items-end">
                                        <div class="w-full">
                                            <label class="text-[10px] text-slate-400 font-bold uppercase mb-1 block">Spesifikasi Hardware (Koma)</label>
                                            <input type="text" name="description" value="{{ $product->description }}" class="bg-transparent border border-slate-200 group-hover:border-orange-300 rounded-lg px-3 py-2 w-full text-xs font-medium text-slate-600 focus:ring-2 focus:ring-orange-500 outline-none" required>
                                        </div>
                                        <button type="submit" class="bg-slate-100 text-slate-600 px-6 py-2 rounded-lg text-xs font-bold hover:bg-orange-500 hover:text-white transition-all shadow-sm h-[38px]">Update</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td class="p-10 text-center"><div class="text-4xl mb-2">📭</div><div class="text-sm font-bold text-slate-400">Belum ada Varian Paket K-CBT.</div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================== -->
<!-- ZONA 2: MANAJEMEN HOSTING REGULER                          -->
<!-- ========================================================== -->
<div class="mb-14">
    <div class="flex items-center mb-6">
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 w-12 h-12 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 mr-4">
            <span class="text-white text-xl">☁️</span>
        </div>
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Zona Manajemen Hosting & Reguler</h2>
            <p class="text-xs font-bold text-blue-600 uppercase tracking-wider">Cloud Server & Domain</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        
        <!-- Kategori Reguler -->
        <div class="bg-white rounded-[2rem] shadow-[0_5px_20px_-5px_rgba(59,130,246,0.1)] border border-blue-100 overflow-hidden flex flex-col">
            <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-black text-slate-800 text-lg">📁 Kategori Reguler</h3>
                <span class="text-[10px] font-black bg-blue-100 text-blue-700 px-3 py-1 rounded-full tracking-widest">GLOBAL FEATURES</span>
            </div>
            
            <div class="p-6 bg-slate-50/50 border-b border-slate-100">
                <form action="{{ route('admin.category.store') }}" method="POST" class="flex flex-col md:flex-row gap-3">
                    @csrf
                    <input type="hidden" name="sort_order" value="2">
                    <input type="text" name="name" placeholder="Kategori (Hosting/VPS)" class="w-full md:w-1/3 bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all shadow-sm" required>
                    <div class="w-full md:w-2/3 flex gap-2">
                        <input type="text" name="description" placeholder="Fitur Global (Pisahkan dgn Titik)..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all shadow-sm" required>
                        <button type="submit" class="bg-slate-900 text-white font-black px-5 py-2.5 rounded-xl hover:bg-blue-600 transition-colors shadow-md shrink-0">+</button>
                    </div>
                </form>
            </div>

            <div class="p-0 overflow-y-auto max-h-[350px] flex-1">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-slate-100">
                        @forelse($regCategories as $category)
                        <tr class="hover:bg-blue-50/40 transition-colors group">
                            <td class="p-6">
                                <form action="{{ route('admin.category.update', $category->id) }}" method="POST" class="flex flex-col lg:flex-row gap-3">
                                    @csrf @method('PUT')
                                    <input type="text" name="name" value="{{ $category->name }}" class="bg-transparent border border-slate-200 group-hover:border-blue-300 rounded-lg px-3 py-2 w-full lg:w-1/3 text-sm font-black text-slate-800 focus:ring-2 focus:ring-blue-500 outline-none" required>
                                    <textarea name="description" rows="1" class="bg-transparent border border-slate-200 group-hover:border-blue-300 rounded-lg px-3 py-2 w-full lg:w-2/3 text-xs text-slate-600 focus:ring-2 focus:ring-blue-500 outline-none" required>{{ $category->description }}</textarea>
                                    <button type="submit" class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg text-xs font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm">Simpan</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td class="p-10 text-center"><div class="text-4xl mb-2">📭</div><div class="text-sm font-bold text-slate-400">Belum ada Kategori Reguler.</div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paket Reguler -->
        <div class="bg-white rounded-[2rem] shadow-[0_5px_20px_-5px_rgba(59,130,246,0.1)] border border-blue-100 overflow-hidden flex flex-col">
            <div class="px-8 py-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-black text-slate-800 text-lg">☁️ Varian Layanan Reguler</h3>
                <span class="text-[10px] font-black bg-blue-100 text-blue-700 px-3 py-1 rounded-full tracking-widest">ALL FEATURES</span>
            </div>
            
            <div class="p-6 bg-slate-50/50 border-b border-slate-100">
                <form action="{{ route('admin.product.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="hidden" name="is_cbt_panel" value="0"> 
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <select name="category_id" class="bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 outline-none shadow-sm" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($regCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="name" placeholder="Nama Layanan" class="bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-blue-500 outline-none shadow-sm" required>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">Rp</span>
                            <input type="number" name="price" placeholder="Harga/Bln" class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm font-black text-slate-700 focus:ring-2 focus:ring-blue-500 outline-none shadow-sm" required>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-3">
                        <input type="text" name="description" placeholder="Deskripsi/Fitur Produk (Pisahkan dgn Titik)" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:ring-2 focus:ring-blue-500 outline-none shadow-sm" required>
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black px-6 py-2.5 rounded-xl shadow-[0_5px_15px_rgba(59,130,246,0.4)] hover:shadow-[0_8px_20px_rgba(59,130,246,0.6)] hover:-translate-y-0.5 transition-all shrink-0">
                            + LAYANAN
                        </button>
                    </div>
                </form>
            </div>

            <div class="p-0 overflow-y-auto max-h-[350px] flex-1">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-slate-100">
                        @forelse($regProducts as $product)
                        <tr class="hover:bg-blue-50/40 transition-colors group">
                            <td class="p-6">
                                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" class="space-y-3">
                                    @csrf @method('PUT')
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                                        <div class="col-span-4">
                                            <label class="text-[10px] text-slate-400 font-bold uppercase mb-1 block">Nama Layanan</label>
                                            <input type="text" name="name" value="{{ $product->name }}" class="bg-transparent border border-slate-200 group-hover:border-blue-300 rounded-lg px-3 py-2 w-full text-sm font-black text-slate-800 focus:ring-2 focus:ring-blue-500 outline-none" required>
                                        </div>
                                        <div class="col-span-5 relative">
                                            <label class="text-[10px] text-slate-400 font-bold uppercase mb-1 block">Harga (Rp)</label>
                                            <input type="number" name="price" value="{{ $product->price }}" class="bg-transparent border border-slate-200 group-hover:border-blue-300 rounded-lg px-3 py-2 w-full text-sm font-mono font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 outline-none" required>
                                        </div>
                                        <div class="col-span-3">
                                            <label class="text-[10px] text-slate-400 font-bold uppercase mb-1 block">Diskon (%)</label>
                                            <input type="number" name="discount_percent" value="{{ $product->discount_percent }}" class="bg-transparent border border-slate-200 group-hover:border-blue-300 rounded-lg px-3 py-2 w-full text-sm text-center font-bold text-rose-500 focus:ring-2 focus:ring-blue-500 outline-none">
                                        </div>
                                    </div>
                                    <div class="flex gap-3 items-end">
                                        <div class="w-full">
                                            <label class="text-[10px] text-slate-400 font-bold uppercase mb-1 block">Deskripsi & Fitur</label>
                                            <input type="text" name="description" value="{{ $product->description }}" class="bg-transparent border border-slate-200 group-hover:border-blue-300 rounded-lg px-3 py-2 w-full text-xs font-medium text-slate-600 focus:ring-2 focus:ring-blue-500 outline-none" required>
                                        </div>
                                        <button type="submit" class="bg-slate-100 text-slate-600 px-6 py-2 rounded-lg text-xs font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm h-[38px]">Update</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td class="p-10 text-center"><div class="text-4xl mb-2">📭</div><div class="text-sm font-bold text-slate-400">Belum ada Layanan Reguler.</div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================== -->
<!-- MANAJEMEN PESANAN K-CBT PREMIUM                            -->
<!-- ========================================================== -->
<div class="bg-white rounded-3xl shadow-[0_8px_30px_rgba(0,0,0,0.04)] border border-slate-100 overflow-hidden mb-10">
    <div class="px-8 py-6 border-b border-slate-100 bg-slate-900 flex flex-col md:flex-row justify-between items-center gap-4">
        <h2 class="text-xl font-bold text-white flex items-center"><span class="mr-3">🚀</span> Pusat Kendali Pesanan K-CBT Premium</h2>
        <span class="text-[10px] font-black text-orange-400 bg-orange-500/10 border border-orange-500/20 px-4 py-1.5 rounded-full uppercase tracking-widest">Update API & Kredensial</span>
    </div>
    
    <div class="p-0 overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap md:whitespace-normal">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-8 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Informasi Klien</th>
                    <th class="px-8 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Status & Aksi</th>
                    <th class="px-8 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Konfigurasi Remote (Login & API)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($orders->where('product.is_cbt_panel', true) as $order)
                <tr class="hover:bg-orange-50/20 transition-colors">
                    
                    <!-- Klien Info -->
                    <td class="px-8 py-6 align-top w-full md:w-1/4">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-lg">
                                {{ strtoupper(substr($order->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-sm font-black text-slate-900">{{ $order->user->name }}</div>
                                <div class="text-[11px] font-semibold text-slate-400">{{ $order->created_at->format('d M Y - H:i') }}</div>
                            </div>
                        </div>
                        <div class="mt-3 bg-orange-50 border border-orange-100 rounded-lg p-2.5 inline-block w-full">
                            <div class="text-xs font-bold text-orange-800 truncate">{{ $order->product->name }}</div>
                            <div class="text-[10px] font-bold text-slate-500 mt-0.5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </div>
                        <a href="https://wa.me/{{ $order->user->whatsapp }}" target="_blank" class="inline-flex items-center mt-3 px-3 py-1.5 bg-[#25D366]/10 text-[#25D366] text-[11px] font-black rounded-lg hover:bg-[#25D366] hover:text-white transition-colors border border-[#25D366]/20">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            Hubungi Klien
                        </a>
                    </td>
                    
                    <!-- Status Form -->
                    <td class="px-8 py-6 align-top w-full md:w-1/6">
                        <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                            @csrf @method('PUT')
                            <label class="text-[9px] text-slate-400 font-bold uppercase mb-1 block">Status Order</label>
                            <select name="status" class="bg-white border border-slate-200 rounded-lg p-2 text-xs font-bold w-full mb-2 focus:ring-2 focus:ring-orange-500 outline-none shadow-sm">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>⚙️ Processing</option>
                                <option value="active" {{ $order->status == 'active' ? 'selected' : '' }}>✅ Active</option>
                            </select>
                            <button type="submit" class="w-full bg-slate-900 text-white py-2 rounded-lg text-[10px] font-black hover:bg-orange-600 transition-colors shadow-sm">UBAH STATUS</button>
                        </form>
                    </td>

                    <!-- Konfigurasi Remote Form -->
                    <td class="px-8 py-6 w-full md:w-7/12">
                        <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="relative">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="{{ $order->status }}">
                            
                            <!-- Box Configuration -->
                            <div class="bg-gradient-to-br from-orange-50 to-rose-50 p-5 rounded-2xl border border-orange-200/60 shadow-inner grid grid-cols-1 md:grid-cols-2 gap-5 relative overflow-hidden">
                                
                                <!-- Dekorasi Latar -->
                                <div class="absolute -right-6 -top-6 text-8xl opacity-[0.03] pointer-events-none">⚙️</div>

                                <div class="space-y-3 relative z-10">
                                    <div class="inline-flex items-center bg-white px-2.5 py-1 rounded-md border border-slate-200 shadow-sm mb-1">
                                        <div class="w-2 h-2 rounded-full bg-blue-500 animate-pulse mr-2"></div>
                                        <span class="text-[9px] font-black text-slate-600 uppercase tracking-wider">Akses Login (Web Klien)</span>
                                    </div>
                                    <input type="url" name="service_url" value="{{ $order->service_url }}" placeholder="URL Login (https://...)" class="w-full bg-white border border-slate-200 rounded-lg text-xs p-2.5 focus:ring-2 focus:ring-blue-500 outline-none shadow-sm transition-all">
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="text" name="service_username" value="{{ $order->service_username }}" placeholder="User" class="bg-white border border-slate-200 rounded-lg text-xs p-2.5 focus:ring-2 focus:ring-blue-500 outline-none shadow-sm transition-all">
                                        <input type="text" name="service_password" value="{{ $order->service_password }}" placeholder="Pass" class="bg-white border border-slate-200 rounded-lg text-xs p-2.5 focus:ring-2 focus:ring-blue-500 outline-none shadow-sm transition-all font-mono">
                                    </div>
                                </div>

                                <div class="space-y-3 relative z-10">
                                    <div class="inline-flex items-center bg-white px-2.5 py-1 rounded-md border border-orange-200 shadow-sm mb-1">
                                        <div class="w-2 h-2 rounded-full bg-orange-500 animate-pulse mr-2"></div>
                                        <span class="text-[9px] font-black text-orange-800 uppercase tracking-wider">Remote API K-CBT</span>
                                    </div>
                                    <input type="url" name="cbt_api_endpoint" value="{{ $order->cbt_api_endpoint }}" placeholder="Endpoint URL (https://...)" class="w-full bg-white border border-orange-200 rounded-lg text-xs p-2.5 focus:ring-2 focus:ring-orange-500 outline-none shadow-sm transition-all font-mono text-orange-900">
                                    <input type="text" name="cbt_api_key" value="{{ $order->cbt_api_key }}" placeholder="API Secret Key (Master Token)" class="w-full bg-white border border-orange-200 rounded-lg text-xs p-2.5 focus:ring-2 focus:ring-orange-500 outline-none shadow-sm transition-all font-mono text-orange-900">
                                </div>
                            </div>

                            <button type="submit" class="w-full mt-3 bg-white border-2 border-orange-500 text-orange-600 font-black text-xs py-3 rounded-xl hover:bg-orange-500 hover:text-white transition-all shadow-sm">
                                SIMPAN SEMUA KONFIGURASI KLIEN
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-8 py-16 text-center"><div class="text-5xl mb-4">📝</div><div class="text-sm font-bold text-slate-400">Belum ada pesanan K-CBT Premium.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ========================================================== -->
<!-- MANAJEMEN PESANAN LAYANAN REGULER                          -->
<!-- ========================================================== -->
<div class="bg-white rounded-3xl shadow-[0_8px_30px_rgba(0,0,0,0.04)] border border-slate-100 overflow-hidden mb-10">
    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50 flex flex-col md:flex-row justify-between items-center gap-4">
        <h2 class="text-xl font-bold text-slate-800 flex items-center"><span class="mr-3">☁️</span> Manajemen Pesanan Layanan Reguler</h2>
    </div>
    
    <div class="p-0 overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap md:whitespace-normal">
            <thead class="bg-white border-b border-slate-100">
                <tr>
                    <th class="px-8 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Client Info</th>
                    <th class="px-8 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Layanan Reguler</th>
                    <th class="px-8 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Setup Akses Klien</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($orders->where('product.is_cbt_panel', false) as $order)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    
                    <td class="px-8 py-6 align-top w-full md:w-1/4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-lg">
                                {{ strtoupper(substr($order->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-sm font-black text-slate-900">{{ $order->user->name }}</div>
                                <div class="text-[11px] font-semibold text-slate-400">{{ $order->created_at->format('d M Y - H:i') }}</div>
                            </div>
                        </div>
                        <a href="https://wa.me/{{ $order->user->whatsapp }}" target="_blank" class="inline-flex items-center mt-3 px-3 py-1.5 bg-[#25D366]/10 text-[#25D366] text-[11px] font-black rounded-lg hover:bg-[#25D366] hover:text-white transition-colors border border-[#25D366]/20">
                            WhatsApp
                        </a>
                    </td>
                    
                    <td class="px-8 py-6 align-top w-full md:w-1/4">
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-3 inline-block w-full">
                            <div class="text-sm font-bold text-slate-800">{{ $order->product->name }}</div>
                            <div class="text-xs font-black text-blue-600 mt-1">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </div>
                    </td>

                    <td class="px-8 py-6 w-full md:w-1/2">
                        <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                            @csrf @method('PUT')
                            
                            <div class="flex flex-col md:flex-row gap-4 mb-4 items-start md:items-center">
                                <div class="w-full md:w-1/3">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase mb-1 block">Status</label>
                                    <select name="status" class="bg-slate-50 border border-slate-200 rounded-lg p-2 text-xs font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 w-full outline-none">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>⚙️ Processing</option>
                                        <option value="active" {{ $order->status == 'active' ? 'selected' : '' }}>✅ Active</option>
                                    </select>
                                </div>
                                <div class="w-full md:w-2/3 space-y-2 border-l-0 md:border-l border-slate-100 md:pl-4">
                                    <label class="text-[10px] font-bold text-blue-500 uppercase tracking-wider block">Kredensial Panel/Hosting</label>
                                    <input type="url" name="service_url" placeholder="URL Login (https://...)" value="{{ $order->service_url }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2 text-xs focus:ring-2 focus:ring-blue-500 outline-none">
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="text" name="service_username" placeholder="Username" value="{{ $order->service_username }}" class="bg-slate-50 border border-slate-200 rounded-lg p-2 text-xs font-mono focus:ring-2 focus:ring-blue-500 outline-none">
                                        <input type="text" name="service_password" placeholder="Password" value="{{ $order->service_password }}" class="bg-slate-50 border border-slate-200 rounded-lg p-2 text-xs font-mono focus:ring-2 focus:ring-blue-500 outline-none">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-slate-900 text-white px-4 py-2.5 rounded-xl hover:bg-blue-600 text-xs font-black transition-colors shadow-md">
                                SIMPAN KONFIGURASI
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-8 py-16 text-center"><div class="text-5xl mb-4">☁️</div><div class="text-sm font-bold text-slate-400">Belum ada pesanan layanan reguler.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ========================================================== -->
<!-- MANAJEMEN DEPOSIT KLIEN                                    -->
<!-- ========================================================== -->
<div class="bg-white rounded-3xl shadow-[0_8px_30px_rgba(0,0,0,0.04)] border border-slate-100 overflow-hidden mb-10">
    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
        <h2 class="text-xl font-bold text-slate-800 flex items-center"><span class="mr-3">💰</span> Validasi Deposit & Top Up</h2>
    </div>
    <div class="p-0 overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap md:whitespace-normal">
            <thead class="bg-white border-b border-slate-100">
                <tr>
                    <th class="px-8 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Trx ID / Waktu</th>
                    <th class="px-8 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Klien</th>
                    <th class="px-8 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Nominal & Status</th>
                    <th class="px-8 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Aksi Validasi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($deposits as $deposit)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5 align-middle">
                        <span class="inline-block bg-slate-100 border border-slate-200 text-slate-600 px-2.5 py-1 rounded text-[10px] font-mono font-black tracking-widest mb-1">{{ $deposit->trx_id }}</span><br>
                        <span class="text-[11px] text-slate-400 font-semibold">{{ $deposit->created_at->format('d M Y, H:i') }}</span>
                    </td>
                    <td class="px-8 py-5 align-middle">
                        <div class="text-sm font-black text-slate-800">{{ $deposit->user->name }}</div>
                        <a href="https://wa.me/{{ $deposit->user->whatsapp }}" target="_blank" class="text-[10px] text-green-600 font-bold hover:underline">WA: {{ $deposit->user->whatsapp }}</a>
                    </td>
                    <td class="px-8 py-5 align-middle">
                        <div class="font-black text-slate-900 text-lg">Rp {{ number_format($deposit->amount, 0, ',', '.') }}</div>
                        <span class="px-3 py-1 inline-flex text-[9px] font-black uppercase rounded-full mt-1.5 border
                            {{ $deposit->status == 'Success' ? 'bg-green-50 text-green-700 border-green-200' : 
                              ($deposit->status == 'Pending' ? 'bg-slate-50 text-slate-600 border-slate-200' : 
                              ($deposit->status == 'Validating' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : 
                              'bg-red-50 text-red-700 border-red-200')) }}">
                            {{ $deposit->status }}
                        </span>
                    </td>
                    <td class="px-8 py-5 align-middle">
                        <form action="{{ route('admin.deposit.update', $deposit->id) }}" method="POST" class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                            @csrf @method('PUT')
                            <select name="status" class="bg-white border border-slate-200 rounded-lg p-2 text-xs font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none w-full sm:w-auto">
                                <option value="Pending" {{ $deposit->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Validating" {{ $deposit->status == 'Validating' ? 'selected' : '' }}>Cek Mutasi</option>
                                <option value="Success" {{ $deposit->status == 'Success' ? 'selected' : '' }}>✅ ACC Saldo</option>
                                <option value="Failed" {{ $deposit->status == 'Failed' ? 'selected' : '' }}>❌ Tolak</option>
                            </select>
                            <button type="submit" class="w-full sm:w-auto bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-xs font-black transition-colors shadow-md" onclick="return confirm('Apakah Anda yakin? Jika Status Success, saldo akan otomatis bertambah ke akun klien.');">Eksekusi</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-8 py-16 text-center"><div class="text-5xl mb-4">💳</div><div class="text-sm font-bold text-slate-400">Belum ada request deposit.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection