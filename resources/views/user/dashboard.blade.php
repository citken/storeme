@extends('layouts.app')

@section('content')
<div class="space-y-8">

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
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
            <h3 class="text-xl font-extrabold text-slate-800">Layanan & Detail Akun Anda</h3>
        </div>
        
        <div class="p-8 space-y-6 bg-white">
            @forelse($orders as $order)
                <div class="bg-white border-2 {{ $order->status == 'active' ? 'border-green-400 shadow-md' : 'border-slate-100' }} rounded-xl p-6 flex flex-col md:flex-row justify-between items-start transition-all hover:border-blue-300">
                    
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

                        @if($order->product->is_cbt_panel && $order->status == 'active')
                            <div class="border-t border-slate-100 pt-4 mt-2">
                                <button onclick="toggleApiForm('form-api-{{ $order->id }}')" class="flex items-center justify-center space-x-2 w-full md:w-auto bg-gradient-to-r from-red-600 to-red-800 text-white px-5 py-2.5 rounded-lg font-black text-xs shadow-lg hover:from-red-500 hover:to-red-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    <span>MASTER REMOTE CONTROL</span>
                                </button>

                                <div id="form-api-{{ $order->id }}" class="hidden mt-4 bg-slate-900 p-5 rounded-xl border border-red-500/50 shadow-2xl relative overflow-hidden">
                                    <div class="absolute top-0 right-0 p-4 opacity-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-red-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM11 19.93C7.05 19.43 4 16.05 4 12C4 7.95 7.05 4.57 11 4.07V19.93ZM13 4.07C16.95 4.57 20 7.95 20 12C20 16.05 16.95 19.43 13 19.93V4.07Z"/></svg>
                                    </div>
                                    <div class="relative z-10">
                                        <div class="flex items-center mb-3">
                                            <span class="bg-red-500/20 text-red-400 p-1.5 rounded mr-2"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 9.586 7.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg></span>
                                            <h5 class="text-white font-extrabold text-sm uppercase tracking-wider">Bypass Password K-CBT</h5>
                                        </div>
                                        <form action="{{ route('user.cbt.password', $order->id) }}" method="POST">
                                            @csrf
                                            <div class="grid grid-cols-2 gap-3 mb-3">
                                                <div>
                                                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Target Username</label>
                                                    <input type="text" name="username" value="{{ $order->service_username ?? 'admin' }}" class="w-full bg-slate-800 border border-slate-700 text-white rounded p-2 text-xs font-mono focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" required>
                                                </div>
                                                <div>
                                                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Set Password Baru</label>
                                                    <input type="text" name="new_password" placeholder="Minimal 6 huruf" class="w-full bg-slate-800 border border-slate-700 text-red-400 font-bold rounded p-2 text-xs focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none" required minlength="6">
                                                </div>
                                            </div>
                                            <button type="submit" onclick="this.innerHTML='<span class=\'animate-pulse\'>⚡ MENEMBAK SERVER...</span>'; this.classList.add('opacity-75');" class="w-full bg-gradient-to-r from-red-600 to-red-800 text-white font-black text-xs px-4 py-2.5 rounded hover:from-red-500 hover:to-red-700 shadow-lg shadow-red-900/50 transition">
                                                EKSEKUSI REMOTE 
                                            </button>
                                            <p class="text-[9px] text-slate-500 mt-2 font-medium leading-tight text-center">Tindakan ini akan menimpa password admin K-CBT Anda secara paksa via API Token.</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="w-full md:w-1/2 md:pl-6 md:border-l-2 border-slate-100">
                        @if($order->status == 'active' && $order->service_url)
                            <div class="bg-slate-900 text-white rounded-xl p-5 shadow-inner h-full">
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

    <div class="mt-12">
        <h3 class="text-2xl font-extrabold text-slate-900 mb-6">Pesan Layanan Baru</h3>
        
        @foreach($categories as $category)
            @php 
                $categoryProducts = $products->where('category_id', $category->id);
            @endphp
            
            @if($categoryProducts->count() > 0)
                <div class="mb-12">
                    <h4 class="text-lg font-bold text-slate-800 border-l-4 border-blue-600 pl-3 mb-6">{{ $category->name }}</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
                        
                        @foreach($categoryProducts as $product)
                            
                            @if($product->is_cbt_panel)
                                <div class="bg-gradient-to-b from-slate-900 to-slate-800 rounded-3xl shadow-xl border border-slate-700 hover:border-orange-500 transition-all flex flex-col h-full relative overflow-hidden group">
                                    <div class="absolute top-0 right-0 bg-gradient-to-r from-orange-500 to-red-600 text-white text-[10px] font-black px-4 py-1.5 rounded-bl-xl uppercase tracking-wider shadow-lg z-10">
                                        ⭐ K-CBT Premium
                                    </div>

                                    <div class="p-8 pb-0">
                                        <h3 class="text-2xl font-extrabold text-white mb-6 pr-10">{{ $product->name }}</h3>
                                        
                                        @php
                                            // 1. Ekstrak Spek dari Koma
                                            $desc = $product->description;
                                            preg_match_all('/(\d+\s*(User|GB|Core|NVMe|TB|MB|RAM|Disk))/i', $desc, $specMatches);
                                            $specs = $specMatches[0];
                                            
                                            // 2. Ekstrak Fitur dari Global Settings
                                            $features = array_filter(array_map('trim', explode('.', $cbt_features ?? '')));
                                        @endphp

                                        <div class="flex flex-wrap gap-2 mb-6">
                                            @foreach($specs as $spec)
                                                <span class="bg-orange-400/10 border border-orange-400/20 text-orange-300 text-[10px] font-bold px-3 py-1.5 rounded-full shadow-sm flex items-center">
                                                    ⚡ {{ trim($spec) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="p-8 pt-0 flex-1">
                                        <ul class="space-y-3">
                                            @foreach($features as $feature)
                                                @php $f = trim($feature); @endphp
                                                @if(strlen($f) > 8 && !preg_match('/(User|GB|Core|NVMe|RAM|Disk)/i', $f))
                                                    <li class="flex items-start text-sm text-slate-300 font-medium">
                                                        <svg class="h-5 w-5 text-orange-500 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                        <span>{{ $f }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="p-8 pt-0 mt-auto border-t border-slate-700/50">
                                        <div class="mb-5 pt-5">
                                            <span class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1 block">Harga Tahunan</span>
                                            <div class="flex items-baseline">
                                                <span class="text-3xl font-black text-white tracking-tight">Rp {{ number_format($product->final_price, 0, ',', '.') }}</span>
                                                <span class="text-sm font-bold text-slate-400 ml-1">/thn</span>
                                            </div>
                                        </div>
                                        <form action="{{ route('user.buy', $product->id) }}" method="POST" onsubmit="return confirm('Beli paket {{ $product->name }}?\nSaldo Anda akan dipotong otomatis.');">
                                            @csrf
                                            <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-400 text-white font-extrabold py-3.5 px-4 rounded-xl text-center shadow-lg transition transform hover:-translate-y-0.5">
                                                Pesan K-CBT Sekarang
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            @else
                                <div class="bg-white rounded-3xl shadow-lg border border-slate-100 flex flex-col h-full relative overflow-hidden group">
                                    <div class="p-8 border-b border-slate-50 bg-slate-50/50">
                                        <h3 class="text-2xl font-extrabold text-slate-900 mb-2">{{ $product->name }}</h3>
                                        <div class="mt-4">
                                            <span class="text-3xl font-extrabold text-slate-900">Rp {{ number_format($product->final_price, 0, ',', '.') }}</span>
                                            <span class="text-sm font-semibold text-slate-500">/bln</span>
                                        </div>
                                    </div>

                                    <div class="p-8 flex-1">
                                        <ul class="space-y-3">
                                            @foreach(explode('.', $product->description) as $descLine)
                                                @if(trim($descLine) != '')
                                                    <li class="flex items-start text-sm text-slate-600 font-medium">
                                                        <svg class="h-5 w-5 text-blue-500 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                        <span>{{ trim($descLine) }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="p-8 pt-0 mt-auto">
                                        <form action="{{ route('user.buy', $product->id) }}" method="POST" onsubmit="return confirm('Beli layanan {{ $product->name }}?\nSaldo Anda akan dipotong.');">
                                            @csrf
                                            <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-3.5 px-4 rounded-xl text-center shadow-md transition transform hover:-translate-y-0.5">
                                                Beli Sekarang
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                        
                    </div> </div>
            @endif
        @endforeach
    </div>

</div>

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