@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto mt-10">
    <div class="bg-slate-900 border border-slate-700 rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-5 border-b border-slate-700 bg-slate-800/50">
            <h5 class="text-white font-bold text-lg flex items-center">
                <span class="text-yellow-400 mr-2">💰</span> Isi Saldo Otomatis
            </h5>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('user.deposit') }}" onsubmit="document.getElementById('btnSubmit').innerText = 'Memproses...'; document.getElementById('btnSubmit').disabled = true;">
                @csrf
                <!-- Pilihan Metode -->
                <div class="mb-6">
                    <label class="block text-slate-400 text-sm font-semibold mb-2">Pilih Metode</label>
                    <label class="flex items-center justify-between p-4 bg-slate-800 border border-yellow-500 rounded-xl cursor-pointer">
                        <div class="flex items-center space-x-3">
                            <div class="text-yellow-400 text-2xl">📱</div>
                            <div>
                                <strong class="text-white block">QRIS</strong>
                                <span class="text-slate-400 text-xs">Scan All E-Wallet (OVO, DANA, BCA, dll)</span>
                            </div>
                        </div>
                        <div class="w-5 h-5 bg-yellow-500 rounded-full flex items-center justify-center">
                            <span class="text-slate-900 text-xs font-black">✓</span>
                        </div>
                        <input type="radio" name="method" value="QRIS" checked class="hidden">
                    </label>
                </div>
                
                <!-- Nominal -->
                <div class="mb-6">
                    <label class="block text-slate-400 text-sm font-semibold mb-2">Nominal (Min. 10.000)</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-4 bg-slate-800 border border-r-0 border-slate-700 text-slate-300 rounded-l-lg font-bold">Rp</span>
                        <input type="number" name="amount" min="10000" class="flex-1 bg-slate-900 border border-slate-700 text-white rounded-r-lg p-3 outline-none focus:border-yellow-500 font-bold" placeholder="50000" required>
                    </div>
                </div>

                <button type="submit" id="btnSubmit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-slate-900 font-extrabold py-3.5 rounded-full transition shadow-lg">
                    Buat Tagihan
                </button>
            </form>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('user.dashboard') }}" class="text-slate-500 hover:text-slate-700 text-sm font-medium">Kembali ke Dashboard</a>
    </div>
</div>
@endsection