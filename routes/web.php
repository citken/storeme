<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\Admin\AdminDepositController;

// ==========================================
// 1. PUBLIC ROUTES (Landing Page & Auth)
// ==========================================
// Inject Model ke Landing Page
Route::get('/', function () { 
    $categories = \App\Models\Category::orderBy('sort_order', 'asc')->get();
    $products = \App\Models\Product::with('category')->get();
    
    // Ambil Fitur Global K-CBT (Jika belum ada, buat otomatis default-nya)
    $cbt_features = \App\Models\Setting::firstOrCreate(
        ['key' => 'cbt_features'], 
        ['value' => 'Private Server Dedicated. Anti-Cheat Lock Browser. Auto-Backup Database Harian. Full Support Remote API Password.']
    )->value;
    
    return view('welcome', compact('categories', 'products', 'cbt_features')); 
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 2. WEBHOOK / API / DIRECT LINK
// ==========================================
// Rute ini harus diluar middleware Auth/Admin karena akan
// di-trigger (diklik) langsung dari chat Telegram atau WA Admin.
Route::get('/admin/approve', [AdminDepositController::class, 'approve']);


// ==========================================
// 3. USER AREA (Proteksi: Hanya Login)
// ==========================================
// User Area
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/buy/{product}', [\App\Http\Controllers\UserController::class, 'buyProduct'])->name('user.buy');
    
    // Fitur Tembak API K-CBT
    Route::post('/cbt/change-password/{order}', [\App\Http\Controllers\UserController::class, 'changeCbtPassword'])->name('user.cbt.password');
    
    // Deposit Routes
    Route::get('/deposit', [\App\Http\Controllers\DepositController::class, 'index'])->name('user.deposit');
    Route::post('/deposit', [\App\Http\Controllers\DepositController::class, 'store']);
    Route::get('/deposit/pay/{trx}', [\App\Http\Controllers\DepositController::class, 'pay'])->name('user.deposit.pay');
    Route::post('/deposit/confirm/{trx}', [\App\Http\Controllers\DepositController::class, 'confirm'])->name('user.deposit.confirm');
});


// ==========================================
// 4. ADMIN AREA (Proteksi: Login & Role Admin)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // ========================================
    // K-PROJECTS FIX: Manajemen Kategori 
    // ========================================
    Route::post('/category', [AdminController::class, 'storeCategory'])->name('admin.category.store');
    Route::put('/category/{id}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    
    // ========================================
    // Manajemen Produk & Harga
    // ========================================
    Route::post('/product', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::put('/product/{product}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::post('/product/bulk-price', [AdminController::class, 'bulkUpdatePrice'])->name('admin.product.bulk_price');
    
    // ========================================
    // Manajemen Pesanan & Pengiriman Akses
    // ========================================
    Route::put('/order/{order}', [AdminController::class, 'updateOrderStatus'])->name('admin.order.update');
    Route::put('/deposit/{deposit}', [AdminController::class, 'updateDepositStatus'])->name('admin.deposit.update');
    Route::post('/settings/cbt', [AdminController::class, 'updateCbtFeatures'])->name('admin.settings.cbt');
    // Tambahkan baris ini di dalam grup middleware admin
Route::delete('/category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.category.delete');
Route::delete('/product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');
});