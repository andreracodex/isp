<?php

namespace App\Console\Commands;

use App\Mail\OrderCreated;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTagihan extends Command
{
    protected $signature = 'send:tagihan';
    protected $description = 'Send Tagihan To Customer';

    public function handle()
    {
        $customers = Customer::where('is_active', 1)->get();

        foreach ($customers as $customer) {
            $first = Carbon::now()->addMonth(1)->firstOfMonth()->format('Y-m-d');
            $last = Carbon::now()->addMonth(1)->lastOfMonth()->format('Y-m-d');

            $banks = Bank::where('is_active', 1)->get();

            $count = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                ->where('orders.customer_id', '=', $customer->id)
                ->whereBetween('due_date', [$first, $last])
                ->orderBy('order_id', 'DESC')
                ->groupBy('orders.customer_id', 'due_date', 'order_details.id')
                ->count();

            if ($count == 0) {
                $orderDetail = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                    ->where('orders.customer_id', '=', $customer->id)
                    ->orderBy('order_id', 'DESC')
                    ->groupBy('orders.customer_id', 'due_date', 'order_details.id')
                    ->first();

                $belum = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                    ->leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')
                    ->where('orders.customer_id', '=', $customer->id)
                    ->where('is_payed', 0)
                    ->sum('pakets.harga_paket');

                $newDueDate = Carbon::parse($orderDetail->due_date)->addMonth(1)->format('Y-m-d');

                OrderDetail::create([
                    'due_date' => $newDueDate,
                    'payment_id' => $orderDetail->payment_id,
                    'order_id' => $orderDetail->id,
                ]);

                Mail::to($customer->user->email)->send(new OrderCreated($customer));

                // Send WhatsApp message
                $message = "*Yth Pelanggan GNET*\n\n";
                $message .= "Hallo Bapak/Ibu,\n";
                $message .= "*" . $customer->nama_customer . "*,\n\n";
                $message .= "Tagihan Internet Anda jatuh tempo pada:\n\n";
                $message .= "Bulan : *" . Carbon::parse($newDueDate)->format('F Y') . "*\n";
                $message .= "Total Tagihan : *Rp ". number_format($belum, 0, ',', '.'). "*,-\n";
                $message .= "Pembayaran maksimal : *" . Carbon::parse($newDueDate)->addMonth(1)->endOfMonth()->format('d F Y') . "*.\n\n";
                $message .= "Bank Tersedia :\n";
                $message .= "*BANK MANDIRI* : ". $banks[3]['nomor_akun_rekening']."\n";
                $message .= "*BANK BCA* : ". $banks[2]['nomor_akun_rekening']."\n";
                $message .= "*BANK BRI* : ". $banks[0]['nomor_akun_rekening']."\n";
                $message .= "*BANK BNI* : ". $banks[1]['nomor_akun_rekening']."\n";
                $message .= "A/N PUTUT WAHYUDI\n\n";
                $message .= "Segera lakukan pembayaran sebelum tanggal jatuh tempo\n\n";
                $message .= "Hormat kami\nPT Global Data Network\nJl. Dinoyo Tenun No 109, RT.006/RW.003, Kel, Keputran, Kec, Tegalsari, Kota Surabaya, Jawa Timur 60265.\nPhone : 085731770730 / 085648747901\nhttps://www.gnet.co.id";

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
                        'Authorization: F#3Ny@o4WUtC7SYuiEUx' //change TOKEN to your actual token
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);

                $isi = json_decode($response, true);
                if (isset($isi['detail']) && isset($isi['process'])) {
                    $this->info('==============================');
                    $this->info('Berhasil Mengirim WA dan Email atas Nama : ' . $customer->nama_customer);
                    $this->info('Nomor Pelanggan : ' . convert_phone($customer->nomor_telephone));
                    $this->info('Nomor Telephone : ' . $customer->nomor_layanan);
                    $this->info('==============================');
                }
            } else {
                $this->info('==============================');
                $this->info('Sudah ada tagihan customer : ' . $customer->nama_customer);
                $this->info('Nomor Pelanggan : ' . $customer->nomor_layanan);
                $this->info('Via WA dan Email');
                $this->info('==============================');
            }
        }
    }
}
