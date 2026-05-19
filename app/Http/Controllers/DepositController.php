<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DepositController extends Controller
{
    // --- KONFIGURASI BOT ---
    private $tg_token   = "5801381023:AAFG9nJ3Z6dBZKQKeEfc7HfzBMIxtVjdWE0";
    private $tg_chat_id = "5976316844";
    private $wa_admin   = "085281692007";
    private $domain_web = "localhost:8000"; 
    private $secret_key = "KUNCI_RAHASIA_KIMEI_2025";
    private $my_qris    = "00020101021126610014COM.GO-JEK.WWW01189360091432677368700210G2677368700303UMI51440014ID.CO.QRIS.WWW0215ID10254671641540303UMI5204899953033605802ID5918K Project, Digital6005METRO61053411462070703A01630477A1";

    public function index() {
        return view('user.deposit');
    }

    public function store(Request $request) {
        $request->validate(['amount' => 'required|numeric|min:10000']);
        
        $trx_id = "DEP-" . time();
        Deposit::create([
            'user_id' => Auth::id(),
            'trx_id'  => $trx_id,
            'amount'  => $request->amount,
            'method'  => 'QRIS',
            'status'  => 'Pending'
        ]);

        return redirect()->route('user.deposit.pay', $trx_id);
    }

    public function pay($trx_id) {
        $deposit = Deposit::where('trx_id', $trx_id)->where('user_id', Auth::id())->firstOrFail();
        
        if ($deposit->status !== 'Pending') {
            return redirect()->route('user.dashboard')->with('success', 'Deposit sudah diproses.');
        }

        $qris_dinamis = $this->generateQris($this->my_qris, $deposit->amount);
        
        return view('user.deposit_pay', compact('deposit', 'qris_dinamis'));
    }

    public function confirm($trx_id) {
        $deposit = Deposit::where('trx_id', $trx_id)->where('user_id', Auth::id())->firstOrFail();
        $user = Auth::user();

        // Update Status
        $deposit->update(['status' => 'Validating']);

        // Generate Link ACC
        $code = md5($deposit->trx_id . $this->secret_key);
        $link_acc = $this->domain_web . "/admin/approve.php?trx=" . $deposit->trx_id . "&code=" . $code;

        // Teks Telegram (Tanpa Foto)
        $amount_str = number_format($deposit->amount, 0, ',', '.');
        $caption_tg  = "🔔 <b>KONFIRMASI TRANSFER MASUK</b>\n";
        $caption_tg .= "User: <b>{$user->name}</b> ({$user->whatsapp})\n";
        $caption_tg .= "Jml: <b>Rp {$amount_str}</b>\n";
        $caption_tg .= "ID: <code>{$deposit->trx_id}</code>\n\n";
        $caption_tg .= "Klik tombol di bawah untuk ACC Saldo.";

        // Kirim via Telegram API
        Http::post("https://api.telegram.org/bot{$this->tg_token}/sendMessage", [
            'chat_id' => $this->tg_chat_id,
            'text' => $caption_tg,
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => [[['text' => '✅ TERIMA / ACC SALDO', 'url' => $link_acc]]]
            ])
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Konfirmasi berhasil dikirim. Saldo akan bertambah setelah Admin mengecek transfer Anda.');
    }

    // --- FUNGSI GENERATOR QRIS DINAMIS (CRC16-CCITT) ---
    private function generateQris($qris_raw, $amount) {
        $qris_content = substr($qris_raw, 0, -4); 
        $qris_content = str_replace("010211", "010212", $qris_content);
        $amount_str = (string)$amount;
        $tag54 = "54" . sprintf("%02d", strlen($amount_str)) . $amount_str;
        
        $pos58 = strpos($qris_content, "5802ID");
        if ($pos58 !== false) { 
            $part1 = substr($qris_content, 0, $pos58); 
            $part2 = substr($qris_content, $pos58); 
            $new_qris_body = $part1 . $tag54 . $part2; 
        } else { 
            $new_qris_body = substr($qris_content, 0, -4) . $tag54 . "6304"; 
        }
        
        if (substr($new_qris_body, -4) != "6304") { 
            $new_qris_body = str_replace("6304", "", $new_qris_body) . "6304"; 
        }
        
        $crc = 0xFFFF; 
        for ($i = 0; $i < strlen($new_qris_body); $i++) { 
            $x = (($crc >> 8) ^ ord($new_qris_body[$i])) & 0xFF; 
            $x ^= $x >> 4; 
            $crc = (($crc << 8) ^ ($x << 12) ^ ($x << 5) ^ $x) & 0xFFFF; 
        }
        return $new_qris_body . strtoupper(sprintf("%04x", $crc));
    }
}