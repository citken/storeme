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
    // --- FITUR KEREN: REMOTE API GANTI PASSWORD K-CBT ---
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
            // URL Tepat sasaran ke web.php (tanpa /api/)
            $endpoint = rtrim($order->cbt_api_endpoint, '/') . '/system/remote-reset-admin';
            
            $response = Http::timeout(15)
                ->withoutVerifying() 
                ->withHeaders([
                    'Accept' => 'application/json'
                ])
                ->post($endpoint, [
                    'master_token' => $order->cbt_api_key, 
                    'username'     => $order->service_username, 
                    'new_password' => $request->new_password
                ]);

            // 4. Cek Hasil Respon Server CBT
            $res = $response->json();

            // Pastikan respon valid JSON dan success
            if ($response->successful() && is_array($res) && isset($res['success']) && $res['success']) {
                // Simpan password baru di database K-Host
                $order->update(['service_password' => $request->new_password]);
                
                return back()->with('success', '⚡ ' . $res['message']);
            } else {
                // K-AI FIX: TANGKAP RESPON MENTAH JIKA BUKAN JSON
                $rawBody = trim(strip_tags($response->body()));
                $snippet = substr($rawBody, 0, 150); // Ambil 150 karakter pertama
                
                $errorMsg = isset($res['message']) ? $res['message'] : "Respon Mentah (HTTP " . $response->status() . "): " . ($snippet ?: 'BLANK / KOSONG');
                
                return back()->withErrors(['GAGAL: ' . $errorMsg]);
            }

        } catch (\Exception $e) {
            return back()->withErrors(['Gagal terhubung ke Server K-CBT. Detail: ' . $e->getMessage()]);
        }
    }
}