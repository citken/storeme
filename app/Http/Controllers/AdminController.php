<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller 
{
   public function dashboard() {
        $orders = Order::with(['user', 'product'])->latest()->get();
        $categories = Category::orderBy('sort_order', 'asc')->get(); 
        $products = Product::with('category')->get();
        $deposits = Deposit::with('user')->latest()->get();
        
        $cbt_features = \App\Models\Setting::firstOrCreate(['key' => 'cbt_features'], ['value' => 'Private Server Dedicated. Anti-Cheat Lock Browser.'])->value;

        return view('admin.dashboard', compact('orders', 'categories', 'products', 'deposits', 'cbt_features'));
    }

    public function updateCbtFeatures(Request $request) {
        \App\Models\Setting::updateOrCreate(['key' => 'cbt_features'], ['value' => $request->cbt_features]);
        return redirect()->back()->with('success', 'Deskripsi Fitur Global K-CBT berhasil diperbarui!');
    }

    // ==========================================================
    // MANAJEMEN KATEGORI & FITUR GLOBAL
    // ==========================================================
    
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'required|integer',
        ]);

        \App\Models\Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->back()->with('success', 'Kategori dan Fitur Utama berhasil ditambahkan!');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category = \App\Models\Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Kategori dan Fitur Utama berhasil diperbarui!');
    }

    public function storeProduct(Request $request) {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'logo_path' => 'nullable|image|max:2048',
        ]);

        // FIX: Gunakan value input, bukan has() — has() selalu true meski value="0"
        $validated['is_cbt_panel'] = (int) $request->input('is_cbt_panel', 0);
        $validated['discount_percent'] = $validated['discount_percent'] ?? 0;

        if ($request->hasFile('logo_path')) {
            $validated['logo_path'] = $request->file('logo_path')->store('product_logos', 'public');
        }

        Product::create($validated);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function updateProduct(Request $request, Product $product) {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id', // FIX: tambahkan agar kategori tersimpan saat update
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'description' => 'required|string',
        ]);

        $validated['discount_percent'] = $validated['discount_percent'] ?? 0;
        $product->update($validated);
        return redirect()->back()->with('success', 'Produk berhasil diupdate.');
    }

    public function bulkUpdatePrice(Request $request) {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:nominal,percent'
        ]);

        $products = Product::all();
        foreach($products as $product) {
            if ($request->type === 'nominal') {
                $product->price += $request->amount;
            } else { 
                $product->price += ($product->price * ($request->amount / 100));
            }
            $product->save();
        }
        return redirect()->back()->with('success', 'Harga seluruh produk berhasil dinaikkan secara serentak!');
    }

    public function updateOrderStatus(Request $request, Order $order) {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,active,completed,cancelled',
            'cbt_api_endpoint' => 'nullable|url',
            'cbt_api_key' => 'nullable|string',
            'service_url' => 'nullable|url',
            'service_username' => 'nullable|string',
            'service_password' => 'nullable|string'
        ]);
        
        $order->update($validated);
        return redirect()->back()->with('success', 'Status & Kredensial Pesanan berhasil diupdate.');
    }

    public function updateDepositStatus(Request $request, Deposit $deposit) {
        $request->validate([
            'status' => 'required|in:Pending,Validating,Success,Failed'
        ]);

        if ($deposit->status === 'Success' && $request->status === 'Success') {
            return redirect()->back()->withErrors(['Deposit ini sudah berstatus Success dan saldo sudah ditambahkan sebelumnya.']);
        }

        try {
            DB::transaction(function () use ($deposit, $request) {
                $newStatus = $request->status;

                if ($newStatus === 'Success' && $deposit->status !== 'Success') {
                    $user = clone $deposit->user;
                    $user->balance += $deposit->amount;
                    $user->save();
                }

                if ($deposit->status === 'Success' && $newStatus !== 'Success') {
                    $user = clone $deposit->user;
                    $user->balance -= $deposit->amount;
                    $user->save();
                }

                $deposit->status = $newStatus;
                $deposit->save();
            });

            return redirect()->back()->with('success', 'Status Deposit berhasil diproses.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Gagal memproses deposit: ' . $e->getMessage()]);
        }
    }
    public function deleteCategory($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        // Opsional: Cek apakah ada produk di dalam kategori ini sebelum menghapus
        if(\App\Models\Product::where('category_id', $id)->count() > 0) {
            return back()->withErrors(['Gagal: Kategori ini masih memiliki layanan/produk.']);
        }
        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }

    public function deleteProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Layanan/Paket berhasil dihapus!');
    }
}