<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CbtController extends Controller 
{
    // API untuk menerima request ganti password admin CBT dari sisi K-Host
    public function updateCbtAdminPassword(Request $request) {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'new_password' => 'required|min:8',
            'user_id' => 'required|exists:users,id'
        ]);

        $order = Order::where('id', $validated['order_id'])
                      ->where('user_id', $validated['user_id'])
                      ->whereHas('product', function($q) { $q->where('is_cbt_panel', true); })
                      ->where('status', 'active')
                      ->firstOrFail();

        if (!$order->cbt_api_endpoint || !$order->cbt_api_key) {
            return response()->json(['error' => 'API K-CBT belum diatur oleh Admin K-Host.'], 403);
        }

        // Trigger request ke server CBT aktual client
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $order->cbt_api_key,
        ])->post($order->cbt_api_endpoint . '/api/change-admin-password', [
            'new_password' => $validated['new_password']
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Password Admin K-CBT berhasil diubah via API!'], 200);
        }

        return response()->json(['error' => 'Gagal terhubung ke Panel K-CBT client.'], 500);
    }
}