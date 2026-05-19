<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class SetupSystem extends Command
{
    protected $signature = 's:migrate';
    protected $description = 'Setup database, seeding, dan akun admin';

    public function handle()
    {
        $this->info('--- Memulai Setup K-Host System ---');

        // 1. Jalankan Migrasi
        $this->comment('Running migrations...');
        Artisan::call('migrate:fresh');
        
        // 2. Jalankan Seeder
        $this->comment('Running seeders...');
        Artisan::call('db:seed', ['--class' => 'CbtSeeder']);

        // 3. Setup Admin (Menyesuaikan dengan Model User Anda: menggunakan 'role')
        $this->comment('Creating Admin Account...');
        User::updateOrCreate(
            ['email' => 'keyzal0728@gmail.com'],
            [
                'name' => 'Admin K-Host',
                'password' => Hash::make('keyzal'),
                'role' => 'admin', // Menggunakan kolom 'role' sesuai Model Anda
                'whatsapp' => '08000000000' // Default dummy jika wajib diisi
            ]
        );

        $this->info('--- Setup Selesai! ---');
        $this->info('Admin Email: keyzal0728@gmail.com');
        $this->info('Admin Password: keyzal');
    }
}