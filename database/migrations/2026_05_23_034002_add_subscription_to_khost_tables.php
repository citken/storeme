<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // 1. Tambah durasi langganan di tabel produk
        Schema::table('products', function (Blueprint $table) {
            $table->integer('duration_months')->default(1)->after('price'); // 0 = Lifetime/Selamanya
        });

        // 2. Tambah masa tenggang dan status suspend di tabel orders
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->after('status');
            $table->boolean('is_suspended')->default(false)->after('expires_at');
        });
    }

    public function down(): void {
        Schema::table('products', function (Blueprint $table) { $table->dropColumn('duration_months'); });
        Schema::table('orders', function (Blueprint $table) { $table->dropColumn(['expires_at', 'is_suspended']); });
    }
};