<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Illuminate\Support\Str;

class AutoSuspendKHost extends Command
{
    protected $signature = 'khost:suspend';
    protected $description = 'Suspend layanan expired & ubah password via API K-CBT otomatis';

    public function handle()
    {
        // Cari layanan yang waktunya sudah lewat (Expired), masih "Active", dan Belum Di-Suspend
        $expiredOrders = Order::whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->where('is_suspended', false)
            ->where('status', 'active')
            ->get();

        $count = 0;
        foreach ($expiredOrders as $order) {
            $this->info("Men-suspend Order ID: {$order->id} (User: {$order->user->name})");

            $newPassword = 'BLOCKED-' . strtoupper(Str::random(6));

            // Jika itu CBT Panel & Punya API, Eksekusi Tembakan API!
            if ($order->product->is_cbt_panel && !empty($order->cbt_api_endpoint) && !empty($order->cbt_api_key)) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, rtrim($order->cbt_api_endpoint, '/') . "/system/remote-reset-admin");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                    'master_token' => $order->cbt_api_key,
                    'username' => $order->service_username ?? 'admin',
                    'new_password' => $newPassword
                ]));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_exec($ch);
                curl_close($ch);
            }

            // Ganti password di database K-Host menjadi BLOCKED-XXX
            $order->service_password = $newPassword;
            // Tandai tersuspend agar tidak dilooping terus-menerus
            $order->is_suspended = true; 
            $order->save();
            
            $count++;
        }

        $this->info("Selesai! {$count} Layanan berhasil di Suspend/Ganti Password.");
    }
}