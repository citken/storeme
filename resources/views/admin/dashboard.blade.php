@extends('layouts.app')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-black text-slate-800">Admin Control Panel</h1>
    <p class="text-slate-500">Kelola Infrastruktur Hosting dan K-CBT Premium Anda.</p>
</div>

<!-- ============================================================== -->
<!-- BAGIAN 1: KATEGORI & PRODUK REGULER (HOSTING/DOMAIN)           -->
<!-- ============================================================== -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
    
    <!-- Form Tambah Kategori -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center mb-4">
            <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">📁</span>
            <h2 class="text-xl font-bold text-slate-800">Manajemen Kategori</h2>
        </div>
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold text-slate-700 mb-1">Nama Kategori</label>
                <input type="text" name="name" class="w-full border-slate-300 rounded-lg shadow-sm p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-5">
                <label class="block text-sm font-bold text-slate-700 mb-1">Urutan Tampil (Sort Order)</label>
                <input type="number" name="sort_order" value="0" class="w-full border-slate-300 rounded-lg shadow-sm p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold px-4 py-2.5 rounded-lg shadow hover:bg-blue-700 transition">Simpan Kategori</button>
        </form>
    </div>

    <!-- Form Tambah Produk Reguler (Hosting, dll) -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center mb-4">
            <span class="bg-green-100 text-green-600 p-2 rounded-lg mr-3">☁️</span>
            <h2 class="text-xl font-bold text-slate-800">Tambah Layanan Reguler</h2>
        </div>
        <form action="{{ route('admin.product.store') }}" method="POST">
            @csrf
            <!-- Tidak ada input is_cbt_panel, otomatis jadi false di controller -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Pilih Kategori</label>
                    <select name="category_id" class="w-full border-slate-300 rounded-lg p-2.5" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Nama Layanan</label>
                    <input type="text" name="name" placeholder="Misal: Cloud Hosting 2GB" class="w-full border-slate-300 rounded-lg p-2.5" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-slate-700 mb-1">Deskripsi & Fitur</label>
                <textarea name="description" rows="2" placeholder="Gunakan titik (.) untuk memisah list fitur" class="w-full border-slate-300 rounded-lg p-2.5" required></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Harga (Rp)</label>
                    <input type="number" name="price" class="w-full border-slate-300 rounded-lg p-2.5" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Diskon (%)</label>
                    <input type="number" name="discount_percent" value="0" max="100" class="w-full border-slate-300 rounded-lg p-2.5">
                </div>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white font-bold px-4 py-2.5 rounded-lg shadow hover:bg-green-700 transition">Simpan Layanan Reguler</button>
        </form>
    </div>
</div>

<!-- ============================================================== -->
<!-- BAGIAN 2: SPESIAL SETUP K-CBT PREMIUM (EKSKLUSIF)              -->
<!-- ============================================================== -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
    
    <!-- KOTAK KIRI: Edit Fitur Global K-CBT -->
    <div class="col-span-1 bg-gradient-to-b from-slate-900 to-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700">
        <h2 class="text-xl font-black text-white flex items-center mb-4"><span class="text-orange-500 mr-2">⚙️</span> Fitur Utama K-CBT</h2>
        <p class="text-[11px] text-slate-400 mb-4 font-medium leading-relaxed">Fitur ini akan muncul sebagai <strong class="text-white">Checklist</strong> di semua paket K-CBT. Pisahkan antar fitur dengan titik (.).</p>
        
        <form action="{{ route('admin.settings.cbt') }}" method="POST">
            @csrf
            <textarea name="cbt_features" rows="8" class="w-full bg-slate-900/50 border border-slate-600 rounded-xl p-3 text-sm text-slate-200 focus:ring-orange-500 focus:border-orange-500 mb-4 leading-loose" required>{{ $cbt_features }}</textarea>
            <button type="submit" class="w-full bg-slate-700 hover:bg-orange-600 text-white font-bold py-2.5 rounded-xl transition shadow">Update Fitur Global</button>
        </form>
    </div>

    <!-- KOTAK KANAN: Tambah Varian Kapasitas Server -->
    <div class="col-span-1 lg:col-span-2 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl shadow-xl p-1">
        <div class="bg-white rounded-xl p-6 h-full">
            <h2 class="text-2xl font-black text-slate-800 flex items-center mb-1"><span class="bg-orange-100 p-2 rounded-lg mr-3">🚀</span> Tambah Varian Spesifikasi Server</h2>
            <p class="text-xs text-slate-500 mb-6 font-medium ml-12">Buat paket berdasarkan RAM, Disk, CPU, dan Max User.</p>

            <form action="{{ route('admin.product.store') }}" method="POST">
                @csrf
                <input type="hidden" name="is_cbt_panel" value="1"> 
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Kategori Induk</label>
                        <select name="category_id" class="w-full border-slate-300 rounded-lg p-2.5 font-bold" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ str_contains(strtolower($category->name), 'cbt') ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Nama Paket</label>
                        <input type="text" name="name" placeholder="Misal: K-CBT Enterprise" class="w-full border-slate-300 rounded-lg p-2.5 font-bold text-slate-900" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Spesifikasi Hardware (PISAHKAN DENGAN KOMA)</label>
                    <input type="text" name="description" placeholder="Contoh: 100 User, 2 Core vCPU, 4GB RAM, 20GB NVMe" class="w-full border-orange-300 bg-orange-50 rounded-lg p-3 text-sm font-bold text-orange-900 focus:ring-orange-500" required>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Harga Tahunan (Rp)</label>
                        <input type="number" name="price" placeholder="450000" class="w-full border-slate-300 rounded-lg p-2.5 font-black text-blue-700" required>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Diskon (%)</label>
                        <input type="number" name="discount_percent" value="0" max="100" class="w-full border-slate-300 rounded-lg p-2.5">
                    </div>
                </div>

                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black px-4 py-3 rounded-xl shadow-lg transition transform hover:-translate-y-0.5">
                    + Terbitkan Varian K-CBT
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- BAGIAN 3: DAFTAR PRICELIST (DIPISAH REGULER & K-CBT)           -->
<!-- ============================================================== -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
    
    <!-- TABEL 1: EDIT LAYANAN REGULER -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
            <h2 class="text-lg font-bold text-slate-800">☁️ Layanan Reguler (Hosting)</h2>
        </div>
        <div class="p-0 overflow-y-auto max-h-[500px]">
            <table class="min-w-full divide-y divide-slate-200">
                <tbody class="bg-white divide-y divide-slate-100">
                    @foreach($products->where('is_cbt_panel', false) as $product)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4">
                            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" class="space-y-2">
                                @csrf @method('PUT')
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="name" value="{{ $product->name }}" class="border-slate-300 rounded p-1.5 w-full text-sm font-bold text-slate-800" required>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs font-bold text-slate-500">Rp</span>
                                    <input type="number" name="price" value="{{ $product->price }}" class="border-slate-300 rounded p-1.5 w-full text-sm font-mono" required>
                                    <span class="text-xs font-bold text-slate-500">Disc%</span>
                                    <input type="number" name="discount_percent" value="{{ $product->discount_percent }}" class="border-slate-300 rounded p-1.5 w-16 text-sm text-center">
                                </div>
                                <textarea name="description" rows="2" class="border-slate-300 rounded p-1.5 w-full text-xs text-slate-600" required>{{ $product->description }}</textarea>
                                <button type="submit" class="bg-slate-800 text-white px-4 py-1.5 rounded shadow hover:bg-blue-600 text-xs font-bold w-full transition">Update Data</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- TABEL 2: EDIT PAKET K-CBT PREMIUM -->
    <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-orange-100 bg-orange-50 flex justify-between items-center">
            <h2 class="text-lg font-bold text-orange-800">🚀 Paket K-CBT Premium</h2>
        </div>
        <div class="p-0 overflow-y-auto max-h-[500px]">
            <table class="min-w-full divide-y divide-orange-100">
                <tbody class="bg-white divide-y divide-orange-50">
                    @foreach($products->where('is_cbt_panel', true) as $product)
                    <tr class="hover:bg-orange-50/50">
                        <td class="p-4">
                            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" class="space-y-2">
                                @csrf @method('PUT')
                                <div class="flex items-center space-x-2">
                                    <input type="text" name="name" value="{{ $product->name }}" class="border-orange-300 bg-orange-50 rounded p-1.5 w-full text-sm font-black text-orange-900" required>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs font-bold text-orange-500">Rp</span>
                                    <input type="number" name="price" value="{{ $product->price }}" class="border-orange-300 rounded p-1.5 w-full text-sm font-mono font-bold" required>
                                    <span class="text-xs font-bold text-orange-500">Disc%</span>
                                    <input type="number" name="discount_percent" value="{{ $product->discount_percent }}" class="border-orange-300 rounded p-1.5 w-16 text-sm text-center font-bold">
                                </div>
                                <textarea name="description" rows="2" class="border-orange-300 rounded p-1.5 w-full text-xs text-slate-700 font-medium" required>{{ $product->description }}</textarea>
                                <button type="submit" class="bg-orange-600 text-white px-4 py-1.5 rounded shadow hover:bg-orange-700 text-xs font-bold w-full transition">Update K-CBT</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- BAGIAN 4: MANAJEMEN PESANAN (KIRIM KREDENSIAL & API CBT)       -->
<!-- ============================================================== -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-10">
    <div class="px-6 py-5 border-b border-slate-100 bg-slate-900">
        <h2 class="text-xl font-bold text-white flex items-center"><span class="mr-2">🛒</span> Manajemen Pesanan & Integrasi Layanan</h2>
    </div>
    <div class="p-0 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-500 uppercase tracking-wider">Info Client</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-500 uppercase tracking-wider">Layanan Dipesan</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-500 uppercase tracking-wider">Setup Akses & API CBT (Berikan ke Klien)</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100">
                @forelse($orders as $order)
                <tr class="hover:bg-slate-50">
                    <!-- Kolom 1: Klien -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-black text-slate-900">{{ $order->user->name }}</div>
                        <div class="text-xs text-slate-500 mt-1">{{ $order->created_at->format('d M Y') }}</div>
                        <a href="https://wa.me/{{ $order->user->whatsapp }}" target="_blank" class="inline-flex items-center mt-2 px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded-full hover:bg-green-200">
                            WA: {{ $order->user->whatsapp }}
                        </a>
                    </td>
                    
                    <!-- Kolom 2: Produk -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-slate-800">{{ $order->product->name }}</div>
                        <div class="text-xs font-black text-blue-600 mt-1">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        @if($order->product->is_cbt_panel)
                            <div class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black bg-orange-100 text-orange-700 uppercase tracking-wider border border-orange-200">
                                🚀 K-CBT Premium
                            </div>
                        @endif
                    </td>

                    <!-- Kolom 3: Konfigurasi Form Lengkap -->
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="space-y-3 bg-slate-50 p-4 rounded-xl border border-slate-200">
                            @csrf @method('PUT')
                            
                            <!-- Status -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-bold text-slate-500 w-16">Status:</span>
                                <select name="status" class="border-slate-300 rounded p-1.5 text-xs font-bold text-slate-800 focus:ring-blue-500 flex-1">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>⚙️ Processing (Dikerjakan)</option>
                                    <option value="active" {{ $order->status == 'active' ? 'selected' : '' }}>✅ Active (Selesai)</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                                </select>
                            </div>

                            <hr class="border-slate-200">
                            
                            <!-- Akses Login User -->
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Berikan Akses Login:</span>
                                <input type="url" name="service_url" placeholder="URL Login (https://...)" value="{{ $order->service_url }}" class="border-slate-300 rounded p-1.5 text-xs w-full mb-2">
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="text" name="service_username" placeholder="Username" value="{{ $order->service_username }}" class="border-slate-300 rounded p-1.5 text-xs w-full font-mono">
                                    <input type="text" name="service_password" placeholder="Password" value="{{ $order->service_password }}" class="border-slate-300 rounded p-1.5 text-xs w-full font-mono">
                                </div>
                            </div>

                            <!-- Setup API Khusus CBT -->
                            @if($order->product->is_cbt_panel)
                                <div class="bg-orange-100/50 p-3 rounded-lg border border-orange-200">
                                    <span class="text-[10px] font-black text-orange-800 uppercase tracking-wider block mb-2">Koneksi Remote API K-CBT:</span>
                                    <input type="url" name="cbt_api_endpoint" placeholder="Endpoint URL (https://server-cbt.com)" value="{{ $order->cbt_api_endpoint }}" class="border-orange-300 rounded p-1.5 text-xs w-full mb-2 focus:ring-orange-500">
                                    <input type="text" name="cbt_api_key" placeholder="API Secret Key (Bearer)" value="{{ $order->cbt_api_key }}" class="border-orange-300 rounded p-1.5 text-xs w-full focus:ring-orange-500 font-mono">
                                </div>
                            @endif

                            <button type="submit" class="w-full bg-slate-800 text-white px-3 py-2 rounded-lg hover:bg-blue-600 text-xs font-bold transition shadow-sm mt-2">
                                Simpan Semua Konfigurasi
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-6 py-10 text-center text-slate-500 font-medium">Belum ada pesanan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ============================================================== -->
<!-- BAGIAN 5: MANAJEMEN DEPOSIT / TOP UP                           -->
<!-- ============================================================== -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-10">
    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
        <h2 class="text-xl font-bold text-slate-800 flex items-center"><span class="mr-2">💰</span> Manajemen Deposit Klien</h2>
    </div>
    <div class="p-0 overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-white">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">Trx ID / Waktu</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">Client</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">Nominal & Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase">Aksi Validasi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100">
                @forelse($deposits as $deposit)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-mono bg-slate-100 text-slate-700 px-2 py-1 rounded text-xs font-bold">{{ $deposit->trx_id }}</span><br>
                        <span class="text-[10px] text-slate-500 font-medium mt-1 block">{{ $deposit->created_at->format('d M Y, H:i') }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-slate-800">{{ $deposit->user->name }}</div>
                        <a href="https://wa.me/{{ $deposit->user->whatsapp }}" target="_blank" class="text-xs text-green-600 font-bold hover:underline">WA: {{ $deposit->user->whatsapp }}</a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-black text-slate-900 text-base">Rp {{ number_format($deposit->amount, 0, ',', '.') }}</div>
                        <span class="px-2 py-0.5 inline-flex text-[10px] font-black uppercase rounded-full mt-1
                            {{ $deposit->status == 'Success' ? 'bg-green-100 text-green-700' : ($deposit->status == 'Pending' ? 'bg-slate-100 text-slate-700' : ($deposit->status == 'Validating' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700')) }}">
                            {{ $deposit->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <form action="{{ route('admin.deposit.update', $deposit->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf @method('PUT')
                            <select name="status" class="border border-slate-300 rounded-lg p-2 text-xs font-bold focus:ring-blue-500">
                                <option value="Pending" {{ $deposit->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Validating" {{ $deposit->status == 'Validating' ? 'selected' : '' }}>Validating (Cek Mutasi)</option>
                                <option value="Success" {{ $deposit->status == 'Success' ? 'selected' : '' }}>✅ ACC Saldo Masuk</option>
                                <option value="Failed" {{ $deposit->status == 'Failed' ? 'selected' : '' }}>❌ Tolak</option>
                            </select>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-xs font-bold transition shadow-sm" onclick="return confirm('Apakah Anda yakin? ACC Saldo akan otomatis menambah balance klien.');">Eksekusi</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-10 text-center text-slate-500 font-medium">Belum ada data deposit.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection