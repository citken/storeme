<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CbtSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan data K-CBT lama
        Product::where('is_cbt_panel', true)->delete();
        Category::where('name', 'Sewa Panel K-CBT Premium')->delete();

        // 2. Buat Kategori
        $category = Category::create([
            'name' => 'Sewa Panel K-CBT Premium',
            'sort_order' => 2
        ]);

        // 3. Rumus Deskripsi Standar
        $fiturStandar = 'Fitur Premium: Private Server Dedicated. Anti-Cheat Lock Browser. Auto-Backup Database Harian. Full Support Remote API Password. Upload Bank Soal Unlimited. Bandwidth Unmetered.';

        // 4. Data Paket K-CBT (Harga disesuaikan menjadi Tahunan)
        $cbtPackages = [
            [
                'name' => 'K-CBT Starter (100 User)', 
                'price' => 1500000, // Rp 1.5 Juta / Tahun
                'desc' => 'Kapasitas Max: 100 User Bersamaan. Spesifikasi: 1 Core vCPU, RAM 2GB, Disk 10GB NVMe. ' . $fiturStandar
            ],
            [
                'name' => 'K-CBT Pro (200 User)', 
                'price' => 2500000, // Rp 2.5 Juta / Tahun
                'desc' => 'Kapasitas Max: 200 User Bersamaan. Spesifikasi: 2 Core vCPU, RAM 4GB, Disk 20GB NVMe. ' . $fiturStandar
            ],
            [
                'name' => 'K-CBT Advanced (400 User)', 
                'price' => 4500000, // Rp 4.5 Juta / Tahun
                'desc' => 'Kapasitas Max: 400 User Bersamaan. Spesifikasi: 4 Core vCPU, RAM 8GB, Disk 40GB NVMe. ' . $fiturStandar
            ],
            [
                'name' => 'K-CBT Enterprise (1000+ User)', 
                'price' => 9500000, // Rp 9.5 Juta / Tahun
                'desc' => 'Kapasitas Max: 1000+ User Bersamaan. Spesifikasi: 8 Core vCPU, RAM 16GB, Disk 80GB NVMe. ' . $fiturStandar
            ],
        ];

        // 5. Eksekusi
        foreach ($cbtPackages as $pkg) {
            Product::create([
                'category_id' => $category->id,
                'name' => $pkg['name'],
                'description' => $pkg['desc'],
                'price' => $pkg['price'],
                'discount_percent' => 0,
                'is_cbt_panel' => true,
            ]);
        }
    }
}