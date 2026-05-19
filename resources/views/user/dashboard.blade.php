@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- Header & Saldo -->
    <div class="bg-gradient-to-r from-blue-700 to-indigo-900 rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row items-center justify-between p-8 border border-blue-800">
        <div class="text-white mb-6 md:mb-0">
            <h2 class="text-3xl font-extrabold mb-2">Halo, {{ Auth::user()->name }}!</h2>
            <p class="text-blue-200">Kelola layanan infrastruktur Cloud & K-CBT Anda.</p>
        </div>
        
        <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-6 w-full md:w-80 text-white shadow-inner">
            <p class="text-sm text-blue-200 font-bold tracking-wide uppercase mb-1">Saldo Aktif</p>
            <h3 class="text-4xl font-black mb-5 tracking-tight">Rp {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}</h3>
            <a href="{{ route('user.deposit') }}" class="block text-center bg-yellow-400 hover:bg-yellow-300 text-indigo-900 font-extrabold px-6 py-3 rounded-lg transition-all shadow-lg hover:shadow-yellow-400/50 w-full transform hover:-translate-y-0.5">
                + Isi Saldo
            </a>
        </div>
    </div>
    
    <!-- Bagian Riwayat & Detail Akun Layanan -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
            <h3 class="text-xl font-extrabold text-slate-800">Layanan & Detail Akun Anda</h3>
        </div>
        
        <div class="p-8 space-y-6 bg-white">
            @forelse($orders as $order)
                <div class="bg-white border-2 {{ $order->status == 'active' ? 'border-green-400 shadow-md' : 'border-slate-100' }} rounded-xl p-6 flex flex-col md:flex-row justify-between items-start transition-all hover:border-blue-300">
                    
                    <!-- Sisi Kiri: Info Pesanan & Remote API -->
                    <div class="w-full md:w-1/2 mb-4 md:mb-0 pr-0 md:pr-6">
                        <div class="flex items-center space-x-3 mb-2">
                            <h4 class="font-extrabold text-xl text-slate-900">{{ $order->product->name }}</h4>
                            @if($order->product->is_cbt_panel)
                                <span class="bg-orange-100 text-orange-700 text-[10px] font-black uppercase px-3 py-1 rounded-full tracking-wider shadow-sm">K-CBT Panel</span>
                            @endif
                        </div>
                        <div class="text-sm space-y-1 text-slate-600 font-medium mb-4">
                            <p>Tagihan: <span class="font-bold text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                            <p>Status Sistem: 
                                <span class="font-black uppercase px-2 py-0.5 rounded text-xs ml-1
                                    {{ $order->status == 'active' ? 'bg-green-100 text-green-700' : ($order->status == 'processing' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ $order->status }}
                                </span>
                            </p>
                        </div>

                        <!-- FITUR REMOTE API K-CBT -->
                        @if($order->product->is_cbt_panel && $order->status == 'active')
                            <div class="border-t border-slate-100 pt-4 mt-2">
                                <button onclick="toggleApiForm('form-api-{{ $order->id }}')" class="flex items-center justify-center space-x-2 bg-gradient-to-r from-slate-800 to-slate-900 text-white px-4 py-2 rounded-lg font-bold text-xs shadow hover:from-slate-700 hover:to-slate-800 transition w-full md:w-auto">
                                    <span>⚙️ Ubah Password Admin CBT</span>
                                </button>

                                <div id="form-api-{{ $order->id }}" class="hidden mt-3 bg-slate-50 p-3 rounded-lg border border-slate-200">
                                    <form action="{{ route('user.cbt.password', $order->id) }}" method="POST" class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                                        @csrf
                                        <input type="text" name="new_password" placeholder="Password baru..." class="flex-1 border border-slate-300 rounded p-2 text-xs focus:ring-2 focus:ring-blue-500 outline-none" required minlength="6">
                                        <button type="submit" onclick="this.innerHTML='Memproses...'; this.classList.add('opacity-70');" class="bg-blue-600 text-white font-bold text-xs px-4 py-2 rounded hover:bg-blue-700 shadow transition">
                                            Eksekusi
                                        </button>
                                    </form>
                                    <p class="text-[9px] text-slate-400 mt-1 font-medium leading-tight">Sistem akan menembak API ke server Anda untuk reset password.</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sisi Kanan: Kredensial Layanan -->
                    <div class="w-full md:w-1/2 md:pl-6 md:border-l-2 border-slate-100">
                        @if($order->status == 'active' && $order->service_url)
                            <div class="bg-slate-900 text-white rounded-xl p-5 shadow-inner">
                                <h5 class="text-xs font-black text-blue-400 uppercase tracking-wider border-b border-slate-700 pb-2 mb-4">Informasi Login Akses Layanan</h5>
                                
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-[10px] text-slate-400 uppercase font-bold mb-1">Link Akses Panel</p>
                                        <a href="{{ $order->service_url }}" target="_blank" class="text-sm text-blue-300 hover:text-white hover:underline font-medium break-all">{{ $order->service_url }}</a>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 bg-slate-800/50 p-3 rounded-lg border border-slate-700">
                                        <div>
                                            <p class="text-[10px] text-slate-400 uppercase font-bold">Username</p>
                                            <p class="text-sm font-mono text-white mt-1">{{ $order->service_username ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-slate-400 uppercase font-bold">Password</p>
                                            <p class="text-sm font-mono text-white mt-1">{{ $order->service_password ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($order->status == 'processing')
                            <div class="h-full flex items-center justify-center p-6 bg-blue-50 border border-blue-100 rounded-lg">
                                <p class="text-sm text-blue-700 font-bold text-center">⚙️ Server sedang dipersiapkan. Informasi login akan segera muncul di sini.</p>
                            </div>
                        @else
                            <div class="h-full flex items-center justify-center p-6 bg-slate-50 border border-slate-100 rounded-lg">
                                <p class="text-sm text-slate-500 font-medium text-center">Menunggu konfirmasi admin untuk memproses pesanan Anda.</p>
                            </div>
                        @endif
                    </div>

                </div>
            @empty
                <div class="text-center py-10 bg-slate-50 border-2 border-dashed border-slate-200 rounded-xl">
                    <p class="text-slate-500 font-medium">Anda belum memiliki layanan yang aktif.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Bagian Order Baru (Katalog Produk) -->
    <div class="mt-12">
        <h3 class="text-2xl font-extrabold text-slate-900 mb-6">Pesan Layanan Baru</h3>
        
        @foreach($categories as $category)
            @php 
                $categoryProducts = $products->where('category_id', $category->id);
            @endphp
            
            @if($categoryProducts->count() > 0)
                <div class="mb-12">
                    <h4 class="text-lg font-bold text-slate-800 border-l-4 border-blue-600 pl-3 mb-6">{{ $category->name }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        @foreach($categoryProducts as $product)
                            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col hover:shadow-xl hover:border-blue-300 transition-all relative overflow-hidden group">
                                @if($product->is_cbt_panel)
                                    <div class="absolute top-0 right-0 bg-gradient-to-r from-orange-500 to-red-500 text-white text-[10px] font-black px-4 py-1.5 rounded-bl-xl uppercase shadow-md">CBT Premium</div>
                                @endif
                                
                                <h5 class="text-xl font-extrabold text-slate-900 pr-16">{{ $product->name }}</h5>
                                
                                <!-- Render Deskripsi sebagai List -->
                                <div class="mt-4 mb-6 flex-1">
                                    <ul class="space-y-2">
                                        @foreach(explode('.', $product->description) as $descLine)
                                            @if(trim($descLine) != '')
                                                <li class="flex items-start text-sm text-slate-600">
                                                    <svg class="h-4 w-4 text-green-500 mr-2 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    <span>{{ trim($descLine) }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="mt-auto border-t border-slate-100 pt-5">
                                    <div class="flex items-end justify-between mb-4">
                                        <div>
                                            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Harga Berlangganan</p>
                                            <!-- LOGIKA CERDAS: /thn untuk CBT, /bln untuk Hosting -->
                                            <p class="text-2xl font-black text-blue-700">Rp {{ number_format($product->final_price, 0, ',', '.') }}<span class="text-sm text-slate-400 font-medium">/{{ $product->is_cbt_panel ? 'thn' : 'bln' }}</span></p>
                                        </div>
                                    </div>
                                    
                                    <form action="{{ route('user.buy', $product->id) }}" method="POST" onsubmit="return confirm('Beli layanan {{ $product->name }} seharga Rp {{ number_format($product->final_price, 0, ',', '.') }}?\nSaldo Anda akan langsung dipotong.');">
                                        @csrf
                                        <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-md transform hover:-translate-y-0.5">
                                            Beli Sekarang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            @endif
        @endforeach
    </div>

</div>

<!-- Script untuk Toggle Form API -->
<script>
    function toggleApiForm(id) {
        var form = document.getElementById(id);
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
        } else {
            form.classList.add('hidden');
        }
    }
</script>
@endsection