<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http; // Tambahkan ini untuk menembak API

class UserController extends Controller
{
    public function dashboard() {
        $user = Auth::user();
        $orders = Order::with('product')->where('user_id', $user->id)->latest()->get();
        $categories = Category::orderBy('sort_order', 'asc')->get();
        $products = Product::with('category')->get();
        
        $cbt_features = \App\Models\Setting::where('key', 'cbt_features')->first()->value ?? '';

        return view('user.dashboard', compact('orders', 'categories', 'products', 'cbt_features'));
    }

    public function buyProduct(Request $request, Product $product) {
        $user = Auth::user();
        $price = $product->final_price;

        if ($user->balance < $price) {
            return back()->withErrors(['Saldo Anda tidak mencukupi (Kurang Rp ' . number_format($price - $user->balance, 0, ',', '.') . ').']);
        }

        try {
            DB::transaction(function () use ($user, $product, $price) {
                $user->decrement('balance', $price);
                Order::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'status' => 'pending',
                    'total_price' => $price
                ]);
            });

            return back()->with('success', 'Pesanan ' . $product->name . ' berhasil dibuat! Menunggu proses Admin.');
        } catch (\Exception $e) {
            return back()->withErrors(['Gagal memproses pesanan: ' . $e->getMessage()]);
        }
    }

    // --- FITUR KEREN: REMOTE API GANTI PASSWORD K-CBT ---
    public function changeCbtPassword(Request $request, Order $order) {
        $request->validate([
            'new_password' => 'required|string|min:6'
        ]);

        // 1. Validasi Keamanan Hak Akses
        if ($order->user_id !== Auth::id() || $order->status !== 'active' || !$order->product->is_cbt_panel) {
            return back()->withErrors(['Akses ditolak. Layanan tidak valid.']);
        }

        // 2. Cek apakah Admin sudah mengisi URL API dan Key
        if (empty($order->cbt_api_endpoint) || empty($order->cbt_api_key)) {
            return back()->withErrors(['Konfigurasi API belum disetel oleh Admin. Silakan hubungi CS.']);
        }

        // 3. Tembak API ke Server CBT Client
        try {
            $response = Http::timeout(10)->withHeaders([
                'Authorization' => 'Bearer ' . $order->cbt_api_key,
                'Accept'        => 'application/json'
            ])->post(rtrim($order->cbt_api_endpoint, '/') . '/api/change-admin-password', [
                'new_password' => $request->new_password
            ]);

            // 4. Cek Hasil Respon Server CBT
            if ($response->successful()) {
                // Opsional: Simpan password baru di database K-Host agar user bisa melihatnya
                $order->update(['service_password' => $request->new_password]);
                
                return back()->with('success', 'Password Admin K-CBT berhasil diubah langsung di server!');
            } else {
                return back()->withErrors(['Server K-CBT merespon dengan error: ' . $response->body()]);
            }

        } catch (\Exception $e) {
            return back()->withErrors(['Gagal terhubung ke Server K-CBT. Server mungkin sedang offline.']);
        }
    }
}