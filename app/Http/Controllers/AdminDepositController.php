<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDepositController extends Controller
{
    private $secret_key = "KUNCI_RAHASIA_KIMEI_2025";

    public function approve(Request $request)
    {
        $trx = $request->query('trx');
        $code = $request->query('code');

        // 1. Validasi Keamanan (Security Hash Check)
        if ($code !== md5($trx . $this->secret_key)) {
            return response("❌ <b>AKSES DITOLAK!</b><br>Link tidak valid.", 403);
        }

        // 2. Ambil data deposit
        $deposit = Deposit::where('trx_id', $trx)->first();

        if (!$deposit) {
            return response("❌ Transaksi tidak ditemukan.", 404);
        }

        if ($deposit->status === 'Success') {
            return response("✅ Transaksi ini <b>SUDAH SUKSES</b> sebelumnya.", 200);
        }

        // 3. Eksekusi ACC dengan Database Transaction (PENTING!)
        try {
            DB::transaction(function () use ($deposit) {
                // A. Tambah saldo user
                $user = User::find($deposit->user_id);
                $user->balance += $deposit->amount;
                $user->save();

                // B. Update status deposit
                $deposit->status = 'Success';
                $deposit->save();
            });

            // 4. Tampilan Sukses (Mobile Friendly)
            return view('admin.deposit_success', compact('deposit'));

        } catch (\Exception $e) {
            return response("Gagal memproses transaksi: " . $e->getMessage(), 500);
        }
    }
}