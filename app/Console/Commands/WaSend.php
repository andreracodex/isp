<?php

namespace App\Console\Commands;

use App\Mail\OrderCreated;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\SettingsWA;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function App\Http\Helpers\convert_phone;

class WaSend extends Command
{
    protected $signature = 'send:tagihanbywa';
    protected $description = 'Send Tagihan Via WA dan Email to Customer';

    public function handle()
    {
        $customers = Customer::where('is_active', 1)->get();
        $now = Carbon::now()->format('Y-m-d');
        $set = Setting::find(46);
        $was = SettingsWA::where('is_active', 1)->get();

        foreach ($was as $has) {
            foreach ($customers as $customer) {
                $due_date_one = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                    ->where('orders.customer_id', '=', $customer->id)
                    ->where('order_details.is_payed', '=', 0)
                    ->first();

                if ($due_date_one != null) {
                    $diff = Carbon::parse($due_date_one->due_date)->diffInDays($now);

                    if ($has->id == $diff) {
                        $this->sendReminder($customer, $due_date_one, $set);
                    }
                }
            }
        }
    }

    private function sendReminder($customer, $due_date_one, $set)
    {
        try{
            $banks = Bank::where('is_active', 1)->get();
            $belum = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                ->leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')
                ->where('orders.customer_id', '=', $customer->id)
                ->where('order_details.is_payed', 0)
                ->sum('pakets.harga_paket');

            $message = "*Yth Pelanggan GNET*\n\n";
            $message .= "Hallo Bapak/Ibu,\n";
            $message .= "*" . $customer->nama_customer . "*,\n\n";
            $message .= "No Invocie Tagihan : *" . $due_date_one->invoice_number . "*\n";
            $message .= "Bulan : *" . Carbon::parse($due_date_one->due_date)->format('F Y') . "*\n";
            $message .= "Total Tagihan : *Rp " . number_format($belum, 0, ',', '.') . "*,-\n";
            $message .= "Pembayaran maksimal : *" . Carbon::parse($due_date_one->due_date)->format('d F Y') . "*.\n\n";
            $message .= "Bank Tersedia :\n";
            $message .= "*BANK MANDIRI* : " . $banks[3]['nomor_akun_rekening'] . "\n";
            $message .= "*BANK BCA* : " . $banks[2]['nomor_akun_rekening'] . "\n";
            $message .= "*BANK BRI* : " . $banks[0]['nomor_akun_rekening'] . "\n";
            $message .= "*BANK BNI* : " . $banks[1]['nomor_akun_rekening'] . "\n";
            $message .= "A/N *PUTUT WAHYUDI*\n\n";
            $message .= "Segera lakukan pembayaran sebelum tanggal jatuh tempo, untuk mencegah isolir\n\n";
            $message .= "Hormat kami\n*PT. Global Data Network*\nJl. Dinoyo Tenun No 109, RT.006/RW.003, Kel, Keputran, Kec, Tegalsari, Kota Surabaya, Jawa Timur 60265.\nPhone : 085731770730 / 085648747901\n\nhttps://billing.berdikari.web.id/tripay/merchant";

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => convert_phone($customer->nomor_telephone),
                    'message' => $message,
                    'countryCode' => '62', //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $set->value //change TOKEN to your actual token
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $now = Carbon::now()->format('Y-m-d');
            $diff = Carbon::parse($due_date_one->due_date)->diffInDays($now);

            $isi = json_decode($response, true);
            if (isset($isi['detail']) && isset($isi['process'])) {
                $this->info('==============================');
                $this->info('Berhasil Mengirim WA ' . $diff . ' Jatuh Tempo : ' . $customer->nama_customer);
                $this->info('Nomor Telephone : ' . convert_phone($customer->nomor_telephone));
                $this->info('Nomor Layanan : ' . $customer->nomor_layanan);
                $this->info('==============================');
            }
        }catch (Exception $eror){
            $this->warn('==============================');
            $this->warn('Gagal Mengirim WA Jatuh Tempo : ' . $customer->nama_customer);
            $this->warn('Nomor Telephone : ' . convert_phone($customer->nomor_telephone));
            $this->warn('Nomor Layanan : ' . $customer->nomor_layanan);
            $this->warn('==============================');
        }

    }
}
