<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('service_url')->nullable()->after('cbt_api_key');
            $table->string('service_username')->nullable()->after('service_url');
            $table->string('service_password')->nullable()->after('service_username');
        });
    }

    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['service_url', 'service_username', 'service_password']);
        });
    }
};