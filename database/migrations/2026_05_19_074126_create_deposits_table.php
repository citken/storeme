<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Tambah kolom balance di tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('balance', 15, 2)->default(0)->after('role');
        });

        // Buat tabel deposits
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('trx_id')->unique();
            $table->decimal('amount', 15, 2);
            $table->string('method');
            $table->enum('status', ['Pending', 'Validating', 'Success', 'Failed'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('deposits');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
    }
};