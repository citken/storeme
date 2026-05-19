@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto mt-10">
    <div class="bg-slate-900 border border-slate-700 rounded-2xl p-8 text-center shadow-2xl">
        <h5 class="text-white font-extrabold text-xl mb-1">K Project, Digital</h5>
        <p class="text-slate-400 text-sm mb-6">ID: {{ $deposit->trx_id }}</p>
        
        <div class="text-4xl font-black text-yellow-400 mb-6 tracking-tight">
            Rp {{ number_format($deposit->amount, 0, ',', '.') }}
        </div>

        <div class="bg-white p-4 rounded-xl inline-block mb-6 shadow-inner">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode($qris_dinamis) }}" alt="QRIS Dinamis" class="w-48 h-48">
        </div>
        
        <p class="text-slate-300 text-sm mb-6 font-medium">Scan QRIS di atas menggunakan aplikasi E-Wallet atau M-Banking Anda.</p>

        <!-- Tombol Konfirmasi Sederhana -->
        <form method="POST" action="{{ route('user.deposit.confirm', $deposit->trx_id) }}" onsubmit="document.getElementById('btnConfirm').innerText = 'Mengirim Notifikasi...'; document.getElementById('btnConfirm').disabled = true;">
            @csrf
            <button type="submit" id="btnConfirm" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg transition">
                ✅ Saya Sudah Transfer
            </button>
        </form>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('user.dashboard') }}" class="text-slate-500 hover:text-slate-700 text-sm font-medium">Batalkan / Kembali</a>
    </div>
</div>
@endsection