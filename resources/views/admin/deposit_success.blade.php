<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sukses ACC Saldo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#121212] text-white flex items-center justify-center h-screen font-sans">
    <div class="text-center p-6">
        <div class="text-6xl mb-4">✅</div>
        <h2 class="text-green-500 font-bold text-2xl mb-2">BERHASIL!</h2>
        <p class="mb-6">Saldo user telah ditambahkan ke sistem.</p>
        
        <div class="bg-[#181b21] border border-gray-700 p-4 rounded-xl text-left min-w-[300px]">
            <small class="text-gray-400">ID TRX:</small><br>
            <b class="text-white">{{ $deposit->trx_id }}</b><br>
            <hr class="border-gray-600 my-2">
            <small class="text-gray-400">Nominal:</small><br>
            <b class="text-yellow-500">Rp {{ number_format($deposit->amount, 0, ',', '.') }}</b>
        </div>
        
        <br><br>
        <button onclick="window.close()" class="border border-gray-500 text-gray-300 px-6 py-2 rounded-full text-sm hover:bg-gray-800 transition">Tutup Halaman</button>
    </div>
</body>
</html>