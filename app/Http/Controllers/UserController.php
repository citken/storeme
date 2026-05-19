<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

class UserController extends Controller
{
    public function dashboard() {
        $user = Auth::user();
        $orders = Order::with('product')->where('user_id', $user->id)->latest()->get();
        $categories = Category::orderBy('sort_order', 'asc')->get();
        $products = Product::with('category')->get();
        
        $cbt_features = Setting::where('key', 'cbt_features')->first()->value ?? '';

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
            return back()->with('success', 'Pesanan berhasil dibuat! Menunggu proses Admin.');
        } catch (\Exception $e) {
            return back()->withErrors(['Gagal memproses pesanan: ' . $e->getMessage()]);
        }
    }

    // --- MASTER REMOTE CONTROL K-CBT ---
    // --- MASTER REMOTE CONTROL K-CBT ---
    public function changeCbtPassword(Request $request, Order $order) {
        $request->validate([
            'new_password' => 'required|string|min:6',
            'username' => 'required|string'
        ]);

        // 1. Validasi Keamanan
        if ($order->user_id !== Auth::id() || $order->status !== 'active' || !$order->product->is_cbt_panel) {
            return back()->withErrors(['⛔ AKSES DITOLAK: Anda tidak berhak melakukan aksi ini.']);
        }

        // 2. Cek Konfigurasi
        if (empty($order->cbt_api_endpoint) || empty($order->cbt_api_key)) {
            return back()->withErrors(['⛔ KONFIGURASI KOSONG: Admin belum menyetel Endpoint/Token API CBT Anda.']);
        }

        // 3. Setup Target dan Payload
        $target_url = rtrim($order->cbt_api_endpoint, '/');
        // PENTING: Tambahkan /api/ di depannya karena ini akan ditaruh di routes/api.php CBT
        $endpoint = $target_url . "/api/system/remote-reset-admin"; 
        
        $postData = json_encode([ // Ubah menjadi json_encode
            'master_token' => $order->cbt_api_key,
            'username' => trim($request->username),
            'new_password' => $request->new_password
        ]);

        // 4. Eksekusi cURL Remote
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json", // Wajib karena pakai json_encode
            "Accept: application/json"
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        // 5. Analisis Hasil
        if ($curlError) {
            return back()->withErrors(["⛔ TIMEOUT: Gagal Menghubungi Server CBT. Server Anda mungkin sedang offline. Detail: $curlError"]);
        }

        $res = json_decode($response, true);
        if ($httpCode == 200 && isset($res['success']) && $res['success']) {
            // Update UI User
            $order->update([
                'service_username' => trim($request->username),
                'service_password' => $request->new_password
            ]);
            return back()->with('success', '⚡ MASTER REMOTE SUKSES: ' . $res['message']);
        } else {
            // Tangkap pesan error dari CBT atau fallback ke raw response
            $errorDetail = $res['message'] ?? "HTTP Code: $httpCode. Respons: " . strip_tags($response);
            return back()->withErrors(["⛔ GAGAL: $errorDetail"]);
        }
    
    }
}