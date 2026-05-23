@extends('layouts.app')

@section('content')
<div class="space-y-10 max-w-7xl mx-auto pb-10">

    <div class="relative bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 rounded-[2rem] shadow-2xl overflow-hidden border border-slate-800">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20 pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500 rounded-full mix-blend-screen filter blur-[80px]"></div>
            <div class="absolute bottom-0 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-screen filter blur-[80px]"></div>
        </div>

        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between p-10 md:p-12">
            <div class="text-white mb-8 md:mb-0">
                <p class="text-indigo-300 font-bold tracking-widest uppercase text-xs mb-2">Selamat Datang Kembali</p>
                <h2 class="text-4xl md:text-5xl font-black mb-3 tracking-tight">Halo, {{ Auth::user()->name }}!</h2>
                <p class="text-slate-400 text-sm md:text-base font-medium max-w-md leading-relaxed">Kelola seluruh infrastruktur Cloud Hosting dan panel K-CBT Premium Anda dari satu pusat kendali.</p>
            </div>
            
            <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 w-full md:w-80 text-white shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs text-indigo-200 font-black tracking-widest uppercase">Saldo Aktif</p>
                    <span class="bg-green-500/20 text-green-400 p-1.5 rounded-lg"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>
                </div>
                <h3 class="text-4xl font-black mb-6 tracking-tight">Rp {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}</h3>
                <a href="{{ route('user.deposit') }}" class="flex items-center justify-center space-x-2 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-300 hover:to-yellow-400 text-yellow-950 font-black px-6 py-3.5 rounded-xl transition-all shadow-lg hover:shadow-yellow-500/30 w-full transform hover:-translate-y-1">
                    <span>Isi Saldo</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                </a>
            </div>
        </div>
    </div>
    
    <div>
        <div class="flex items-center mb-6">
            <span class="bg-blue-100 text-blue-600 p-2 rounded-xl mr-3 shadow-sm"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg></span>
            <h3 class="text-2xl font-black text-slate-800">Layanan Milik Anda</h3>
        </div>
        
        <div class="grid grid-cols-1 gap-6">
            @forelse($orders as $order)
                <div class="bg-white rounded-2xl border-2 {{ ($order->is_suspended || ($order->expires_at && now()->greaterThan($order->expires_at))) ? 'border-rose-400 shadow-xl shadow-rose-500/10' : ($order->status == 'active' ? 'border-green-400 shadow-xl shadow-green-500/10' : 'border-slate-200 shadow-sm') }} overflow-hidden flex flex-col lg:flex-row transition-all hover:border-blue-400 group">
                    
                    <div class="p-8 w-full lg:w-5/12 flex flex-col justify-center bg-slate-50/50 group-hover:bg-blue-50/30 transition-colors">
                        <div class="flex items-center space-x-3 mb-3">
                            <h4 class="font-black text-2xl text-slate-900">{{ $order->product->name }}</h4>
                            @if($order->product->is_cbt_panel)
                                <span class="bg-gradient-to-r from-orange-500 to-red-500 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow-md">K-CBT Premium</span>
                            @endif
                        </div>
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center text-sm font-bold text-slate-600">
                                <span class="w-24 text-slate-400 uppercase text-[10px] tracking-wider">Total Tagihan</span>
                                <span class="text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center text-sm font-bold text-slate-600">
                                <span class="w-24 text-slate-400 uppercase text-[10px] tracking-wider">Status Sistem</span>
                                @if($order->is_suspended)
                                    <span class="font-black uppercase px-2.5 py-0.5 rounded text-[10px] tracking-wider bg-rose-100 text-rose-700 animate-pulse">SUSPENDED</span>
                                @else
                                    <span class="font-black uppercase px-2.5 py-0.5 rounded text-[10px] tracking-wider
                                        {{ $order->status == 'active' ? 'bg-green-100 text-green-700' : ($order->status == 'processing' ? 'bg-blue-100 text-blue-700 animate-pulse' : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ $order->status }}
                                    </span>
                                @endif
                            </div>
                            
                            @if($order->status == 'active')
                                <div class="flex items-center text-sm font-bold text-slate-600 pt-2 border-t border-slate-200/60 mt-2">
                                    <span class="w-24 text-slate-400 uppercase text-[10px] tracking-wider">Masa Aktif</span>
                                    @if($order->expires_at)
                                        @if(now()->greaterThan($order->expires_at))
                                            <span class="text-rose-600 text-xs font-black bg-rose-100 px-2 py-0.5 rounded">TELAH EXPIRED</span>
                                        @else
                                            <span class="text-slate-900 text-xs bg-slate-200/50 px-2 py-0.5 rounded">{{ $order->expires_at->format('d M Y') }} <span class="text-blue-600">({{ now()->diffInDays($order->expires_at) }} Hari Lagi)</span></span>
                                        @endif
                                    @else
                                        <span class="text-emerald-600 text-xs font-black bg-emerald-100 px-2 py-0.5 rounded">LIFETIME (Selamanya)</span>
                                    @endif
                                </div>
                                
                                @if($order->expires_at)
                                    <div class="mt-4">
                                        <form action="{{ route('user.order.extend', $order->id) }}" method="POST" onsubmit="return confirm('Perpanjang masa aktif layanan ini?\nSaldo Rp {{ number_format($order->product->final_price, 0, ',', '.') }} akan dipotong dari akun Anda.');">
                                            @csrf
                                            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2.5 rounded-lg font-black text-[10px] uppercase tracking-wider shadow-md transition transform hover:-translate-y-0.5 flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Perpanjang (Rp {{ number_format($order->product->final_price, 0, ',', '.') }})
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endif
                        </div>

                        @if($order->product->is_cbt_panel && $order->status == 'active' && !$order->is_suspended)
                            <div class="mt-auto">
                                <button onclick="toggleApiForm('form-api-{{ $order->id }}')" class="flex items-center justify-center space-x-2 w-full bg-slate-900 text-white px-5 py-3 rounded-xl font-black text-xs shadow-lg hover:bg-slate-800 transition transform hover:-translate-y-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" /></svg>
                                    <span>MASTER REMOTE CONTROL</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="w-full lg:w-7/12 border-t lg:border-t-0 lg:border-l border-slate-200 relative">
                        @if($order->is_suspended)
                            <div class="absolute inset-0 z-20 backdrop-blur-md bg-white/60 flex flex-col items-center justify-center p-8 text-center border-l border-rose-200">
                                <div class="w-16 h-16 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mb-4 shadow-inner">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <h4 class="text-xl font-black text-rose-600 mb-2">LAYANAN DITANGGUHKAN</h4>
                                <p class="text-xs font-bold text-slate-600 max-w-sm mb-4">Masa aktif layanan ini telah habis. Sistem telah mengunci akses Panel Anda secara otomatis. Silakan lakukan perpanjangan untuk membuka kembali akses.</p>
                            </div>
                        @endif

                        @if($order->status == 'active' && $order->service_url)
                            <div class="h-full flex flex-col">
                                <div class="p-8 flex-1 bg-white">
                                    <h5 class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4">Informasi Login Akses Panel</h5>
                                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 mb-4">
                                        <p class="text-[10px] text-slate-500 uppercase font-bold mb-1">URL Akses Web/Panel</p>
                                        <a href="{{ $order->service_url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 font-bold break-all flex items-center group-hover:underline">
                                            {{ $order->service_url }} <svg class="w-3 h-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl">
                                            <p class="text-[10px] text-slate-500 uppercase font-bold mb-1">Username</p>
                                            <p class="text-sm font-mono font-black text-slate-900">{{ $order->service_username ?? '-' }}</p>
                                        </div>
                                        <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl relative overflow-hidden">
                                            <p class="text-[10px] text-slate-500 uppercase font-bold mb-1">Password</p>
                                            @if(str_contains($order->service_password, 'BLOCKED') || str_contains($order->service_password, 'SUSPENDED'))
                                                <p class="text-sm font-mono font-black text-rose-600">LOCKED 🔒</p>
                                            @else
                                                <p class="text-sm font-mono font-black text-slate-900">{{ $order->service_password ?? '-' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if($order->product->is_cbt_panel)
                                    <div id="form-api-{{ $order->id }}" class="hidden bg-slate-900 p-8 border-t border-slate-800 relative overflow-hidden">
                                        <div class="absolute top-0 right-0 p-4 opacity-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-red-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM11 19.93C7.05 19.43 4 16.05 4 12C4 7.95 7.05 4.57 11 4.07V19.93ZM13 4.07C16.95 4.57 20 7.95 20 12C20 16.05 16.95 19.43 13 19.93V4.07Z"/></svg>
                                        </div>
                                        <div class="relative z-10">
                                            <div class="flex items-center mb-4">
                                                <h5 class="text-white font-black text-sm uppercase tracking-wider border-l-4 border-red-500 pl-2">Bypass Password Admin K-CBT</h5>
                                            </div>
                                            <form action="{{ route('user.cbt.password', $order->id) }}" method="POST">
                                                @csrf
                                                <div class="grid grid-cols-2 gap-4 mb-4">
                                                    <div>
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Target Username</label>
                                                        <input type="text" name="username" value="{{ $order->service_username ?? 'admin' }}" class="w-full bg-slate-950 border border-slate-700 text-white rounded-lg p-2.5 text-xs font-mono focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition" required>
                                                    </div>
                                                    <div>
                                                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Set Password Baru</label>
                                                        <input type="text" name="new_password" placeholder="Min. 6 huruf" class="w-full bg-slate-950 border border-slate-700 text-red-400 font-bold rounded-lg p-2.5 text-xs focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition" required minlength="6">
                                                    </div>
                                                </div>
                                                <button type="submit" onclick="this.innerHTML='<span class=\'animate-pulse\'>⚡ MENEMBAK API SERVER...</span>'; this.classList.add('opacity-75');" class="w-full bg-gradient-to-r from-red-600 to-red-800 text-white font-black text-xs px-4 py-3 rounded-lg hover:from-red-500 hover:to-red-700 shadow-lg shadow-red-900/50 transition transform hover:-translate-y-0.5">
                                                    EKSEKUSI REMOTE K-CBT
                                                </button>
                                                <p class="text-[10px] text-slate-500 mt-3 font-medium leading-tight text-center">Tindakan ini akan menimpa password admin K-CBT secara paksa via koneksi API.</p>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @elseif($order->status == 'processing')
                            <div class="h-full flex flex-col items-center justify-center p-10 bg-blue-50/50 text-center">
                                <div class="w-16 h-16 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center mb-4 animate-spin-slow">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <h5 class="font-bold text-slate-800 mb-1">Server Sedang Dipersiapkan</h5>
                                <p class="text-xs text-slate-500">Mohon tunggu, tim admin sedang melakukan deployment layanan Anda.</p>
                            </div>
                        @else
                            <div class="h-full flex flex-col items-center justify-center p-10 bg-slate-50/50 text-center">
                                <div class="w-16 h-16 bg-slate-200 text-slate-400 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <h5 class="font-bold text-slate-800 mb-1">Menunggu Konfirmasi Admin</h5>
                                <p class="text-xs text-slate-500">Pesanan Anda telah diterima dan sedang menunggu antrean verifikasi.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-20 bg-white border-2 border-dashed border-slate-200 rounded-3xl">
                    <span class="text-6xl mb-4">🛸</span>
                    <h4 class="text-xl font-bold text-slate-800 mb-2">Belum ada layanan aktif</h4>
                    <p class="text-slate-500 text-sm">Anda belum memiliki layanan. Silakan pesan melalui katalog di bawah.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="pt-10 border-t border-slate-200">
        <div class="flex items-center mb-8">
            <span class="bg-indigo-100 text-indigo-600 p-2 rounded-xl mr-3 shadow-sm"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg></span>
            <h3 class="text-2xl font-black text-slate-800">Katalog Layanan Baru</h3>
        </div>
        
        @foreach($categories as $category)
            @php 
                $categoryProducts = $products->where('category_id', $category->id);
            @endphp
            
            @if($categoryProducts->count() > 0)
                <div class="mb-14">
                    <h4 class="text-xl font-black text-slate-800 border-l-4 border-indigo-600 pl-3 mb-6">{{ $category->name }}</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                        @foreach($categoryProducts as $product)
                            
                            @if($product->is_cbt_panel)
                                <div class="bg-gradient-to-b from-slate-900 to-slate-800 rounded-[2rem] shadow-xl border border-slate-700 hover:border-orange-500 hover:shadow-orange-500/20 transition-all duration-300 flex flex-col h-full relative overflow-hidden group">
                                    <div class="absolute top-0 right-0 bg-gradient-to-r from-orange-500 to-red-600 text-white text-[10px] font-black px-5 py-2 rounded-bl-2xl uppercase tracking-wider shadow-lg z-10">
                                        ⭐ K-CBT Premium
                                    </div>

                                    <div class="p-8 pb-0">
                                        <h3 class="text-3xl font-black text-white mb-6 pr-10 tracking-tight">{{ $product->name }}</h3>
                                        
                                        @php
                                            $desc = $product->description;
                                            preg_match_all('/(\d+\s*(User|GB|Core|NVMe|TB|MB|RAM|Disk))/i', $desc, $specMatches);
                                            $specs = $specMatches[0];
                                            
                                            $features = array_filter(array_map('trim', explode('.', $category->description ?? '')));
                                        @endphp

                                        <div class="flex flex-wrap gap-2.5 mb-6">
                                            @foreach($specs as $spec)
                                                <span class="bg-orange-500/10 border border-orange-500/30 text-orange-400 text-[11px] font-bold px-3.5 py-1.5 rounded-full shadow-sm flex items-center">
                                                    ⚡ {{ trim($spec) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="p-8 pt-2 flex-1">
                                        <ul class="space-y-3">
                                            @foreach($features as $feature)
                                                @php $f = trim($feature); @endphp
                                                @if(strlen($f) > 5 && !preg_match('/(User|GB|Core|NVMe|RAM|Disk)/i', $f))
                                                    <li class="flex items-start text-sm text-slate-300 font-medium">
                                                        <svg class="h-5 w-5 text-orange-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                        <span class="leading-snug">{{ $f }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="p-8 pt-0 mt-auto relative z-10">
                                        @if($product->price == 0)
                                            <div class="bg-slate-900/60 rounded-2xl p-5 mb-5 border border-slate-700/50">
                                                <div class="flex items-baseline text-[#25D366]">
                                                    <span class="text-3xl font-black tracking-tight">Harga Custom</span>
                                                </div>
                                            </div>
                                            <a href="https://wa.me/6288277512080?text={{ urlencode('Halo Admin K-Host, saya tertarik untuk custom harga pada paket K-CBT ' . $product->name . '.') }}" target="_blank" class="block w-full bg-[#25D366] hover:bg-[#128C7E] text-white font-black text-sm py-4 rounded-xl shadow-[0_8px_25px_-8px_rgba(37,211,102,0.4)] text-center transition-all duration-300 transform hover:-translate-y-1 uppercase tracking-wide flex items-center justify-center">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                                Hubungi via WA
                                            </a>
                                        @else
                                            <div class="bg-slate-900/70 rounded-2xl p-5 mb-5 border border-slate-700/40 group-hover:border-slate-600/60 transition-colors duration-400">
                                                <div class="flex justify-between items-center mb-2">
                                                    <span class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.2em]">Investasi</span>
                                                    @if($product->discount_percent > 0)
                                                        <span class="bg-gradient-to-r from-orange-500 to-rose-600 text-white text-[9px] px-2.5 py-0.5 rounded-md font-black uppercase tracking-wider shadow-sm">Save {{ $product->discount_percent }}%</span>
                                                    @endif
                                                </div>
                                                
                                                @if($product->discount_percent > 0)
                                                    <div class="mb-1">
                                                        <span class="relative inline-block text-sm font-bold text-slate-600">
                                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                                            <span class="absolute left-0 top-1/2 w-full h-[2px] bg-orange-500/70 -translate-y-1/2 rounded-full"></span>
                                                        </span>
                                                    </div>
                                                @endif
    
                                                <div class="flex items-baseline text-white">
                                                    <span class="text-xl font-bold mr-1">Rp</span>
                                                    <span class="text-4xl font-black tracking-tight">{{ number_format($product->final_price, 0, ',', '.') }}</span>
                                                    <span class="text-sm font-semibold text-slate-500 ml-2">/{{ $product->duration_months == 0 ? 'Selamanya' : $product->duration_months . ' Bln' }}</span>
                                                </div>
                                            </div>
                                            <form action="{{ route('user.buy', $product->id) }}" method="POST" onsubmit="return confirm('Beli paket {{ $product->name }}?\nSaldo Rp {{ number_format($product->final_price, 0, ',', '.') }} akan dipotong otomatis.');">
                                                @csrf
                                                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-rose-600 hover:from-orange-400 hover:to-rose-500 text-white font-bold py-4 rounded-2xl shadow-[0_8px_25px_-8px_rgba(249,115,22,0.4)] hover:shadow-[0_10px_35px_-8px_rgba(249,115,22,0.6)] hover:-translate-y-0.5 transition-all duration-300 text-sm uppercase tracking-wider">
                                                    Deploy K-CBT Sekarang
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                            @else
                                <div class="bg-white rounded-[2rem] shadow-lg border border-slate-100 hover:shadow-2xl hover:border-blue-200 hover:-translate-y-2 transition-all duration-300 flex flex-col h-full overflow-hidden group">
                                    <div class="p-8 border-b border-slate-50 bg-slate-50/50 group-hover:bg-blue-50/50 transition-colors">
                                        <h3 class="text-2xl font-black text-slate-900 mb-3">{{ $product->name }}</h3>
                                        
                                        @if($product->price == 0)
                                            <div class="flex items-baseline mt-4">
                                                <span class="text-3xl font-black tracking-tight text-[#25D366]">Harga Custom</span>
                                            </div>
                                        @elseif($product->discount_percent > 0)
                                            <div class="mt-4 flex flex-col">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="px-2 py-0.5 rounded bg-rose-100 text-rose-600 text-[10px] font-black uppercase tracking-wider">Hemat {{ $product->discount_percent }}%</span>
                                                    <span class="relative inline-block text-sm font-bold text-slate-400">
                                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                                        <span class="absolute left-0 top-1/2 w-full h-[1.5px] bg-rose-400 -translate-y-1/2"></span>
                                                    </span>
                                                </div>
                                                <div class="flex items-baseline text-slate-900">
                                                    <span class="text-3xl font-black tracking-tight">Rp {{ number_format($product->final_price, 0, ',', '.') }}</span>
                                                    <span class="text-sm font-semibold text-slate-500 ml-1">/{{ $product->duration_months == 0 ? 'Selamanya' : $product->duration_months . ' Bln' }}</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex items-baseline mt-4 text-slate-900">
                                                <span class="text-3xl font-black tracking-tight">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                                <span class="text-sm font-semibold text-slate-500 ml-1">/{{ $product->duration_months == 0 ? 'Selamanya' : $product->duration_months . ' Bln' }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="p-8 flex-1">
                                        @php
                                            $regDesc = $product->description;
                                            $regFeatures = array_filter(array_map('trim', explode('.', $regDesc)));
                                        @endphp
                                        <ul class="space-y-3">
                                            @foreach($regFeatures as $descLine)
                                                @if(strlen(trim($descLine)) > 2)
                                                    <li class="flex items-start text-sm text-slate-600 font-medium">
                                                        <svg class="h-5 w-5 text-indigo-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                        <span class="leading-snug">{{ trim($descLine) }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="p-8 pt-0 mt-auto relative z-10">
                                        @if($product->price == 0)
                                            <a href="https://wa.me/6288277512080?text={{ urlencode('Halo Admin K-Host, saya tertarik untuk custom harga pada layanan ' . $product->name . '.') }}" target="_blank" class="block w-full bg-[#25D366] hover:bg-[#128C7E] text-white font-black text-sm py-4 rounded-xl shadow-[0_8px_25px_-8px_rgba(37,211,102,0.4)] text-center transition-all duration-300 transform hover:-translate-y-1 uppercase tracking-wide flex items-center justify-center">
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                                Hubungi via WA
                                            </a>
                                        @else
                                            <form action="{{ route('user.buy', $product->id) }}" method="POST" onsubmit="return confirm('Beli layanan {{ $product->name }}?\nSaldo Anda akan dipotong.');">
                                                @csrf
                                                <button type="submit" class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-black text-sm py-4 rounded-xl shadow-md transition-all transform hover:-translate-y-1">
                                                    Pilih Paket Ini
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

</div>

<style>
    .animate-spin-slow { animation: spin 3s linear infinite; }
</style>

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