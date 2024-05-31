<?php

namespace App\Console\Commands;

use App\Models\Bank;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\SettingsWA;
use Carbon\Carbon;
use Illuminate\Console\Command;

use function App\Http\Helpers\convert_phone;

class WaTagihan extends Command
{
    protected $signature = 'send:notifwa';
    protected $description = 'Send Tagihan Via WA dan Email to Customer';

    public function handle()
    {
        $customers = Customer::where('is_active', 1)->get();
        $now = Carbon::now()->format('Y-m-d');
        $set = Setting::find(46);
        $tripay_sand_box = Setting::find(49);

        if($tripay_sand_box->value == 'on'){
            $tripay_url = "https://billing.berdikari.web.id/tripay/merchant";
        }else{
            $tripay_url = "https://billing.berdikari.web.id/tripay/merchant";
        }

        $was = SettingsWA::where('is_active', 1)->get();
        foreach ($was as $has) {
            // Notifikasi Tanggal Jatuh Tempo
            if ($has->id == 1) {
                foreach ($customers as $customer) {
                    $result = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                        ->where('orders.customer_id', '=', $customer->id)
                        ->where('order_details.is_payed', 0)
                        ->where('due_date', '=', $now)->first();

                    if ($result != null) {
                        $banks = Bank::where('is_active', 1)->get();
                        $belum = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                            ->leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')
                            ->where('orders.customer_id', '=', $customer->id)
                            ->where('order_details.is_payed', 0)
                            ->sum('pakets.harga_paket');
                        // Mail::to($customer->user->email)->send(new OrderCreated($customer));

                        // Send WhatsApp message
                        $message = Setting::find(51);
                        // Replace <p> tags with newlines
                        $converted = preg_replace('/<p[^>]*>/', '', $message->value);
                        $converted = preg_replace('/<\/p>/', "\n\n", $converted);

                        // Remove <strong> tags
                        $converted = preg_replace('/<strong[^>]*>/', "*", $converted);
                        $converted = preg_replace('/<\/strong>/', "*", $converted);

                        // Remove <i> tags
                        $converted = preg_replace('/<i[^>]*>/', "_", $converted);
                        $converted = preg_replace('/<\/i>/', "_", $converted);

                        // Remove <br> tags
                        $converted = preg_replace('/<br[^>]*>/', "\n", $converted);
                        $converted = preg_replace('/&nbsp;/', '', $converted);

                        $converted = preg_replace('/%customer%/', $customer->nama_customer, $converted);
                        $converted = preg_replace('/%invoices%/', $result->invoice_number, $converted);
                        $converted = preg_replace('/%bulantahun%/', Carbon::parse($now)->format('F Y'), $converted);
                        $converted = preg_replace('/%nominaltagihan%/', "Rp ".number_format($belum, 0, ',', '.').",-", $converted);
                        $converted = preg_replace('/%jatuhtempo%/', Carbon::parse($now)->format('d F Y'), $converted);
                        $converted = preg_replace('/%bankmandiri%/',$banks[3]['nomor_akun_rekening'], $converted);
                        $converted = preg_replace('/%bankbca%/', $banks[2]['nomor_akun_rekening'], $converted);
                        $converted = preg_replace('/%bankbri%/', $banks[0]['nomor_akun_rekening'], $converted);
                        $converted = preg_replace('/%bankbni%/', $banks[1]['nomor_akun_rekening'], $converted);
                        $converted = preg_replace('/%linkurlpayment%/', $tripay_url, $converted);

                        // Nama Perusahaan dan Keterangan Lainnya
                        $aliasperusahaan = Setting::find(6);
                        $namaperusahaan = Setting::find(23);
                        $val1 = Setting::find(24);
                        $val2 = Setting::find(25);
                        $val3 = Setting::find(26);
                        $val4 = Setting::find(27);
                        $alamatperusahaan = ($val1->value.', '.$val2->value.', '.$val3->value.' - '.$val4->value);
                        $phone = Setting::find(29);
                        $phonealternate = Setting::find(19);
                        $urlperusahaan = Setting::find(20);

                        $converted = preg_replace('/%aliasperusahaan%/', $aliasperusahaan->value, $converted);
                        $converted = preg_replace('/%namaperusahaan%/', $namaperusahaan->value, $converted);
                        $converted = preg_replace('/%alamatperusahaan%/', $alamatperusahaan, $converted);
                        $converted = preg_replace('/%phone%/', $phone->value , $converted);
                        $converted = preg_replace('/%phonealternate%/', $phonealternate->value, $converted);
                        $converted = preg_replace('/%urlperusahaan%/', $urlperusahaan->value, $converted);

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
                                'message' => $converted,
                                'countryCode' => '62', //optional
                            ),
                            CURLOPT_HTTPHEADER => array(
                                'Authorization: '.$set->value //change TOKEN to your actual token
                            ),
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);

                        $isi = json_decode($response, true);
                        if (isset($isi['detail']) && isset($isi['process'])) {
                            $this->info('==============================');
                            $this->info('Berhasil Mengirim WA Jatuh Tempo : ' . $customer->nama_customer);
                            $this->info('Nomor Telephone : ' . convert_phone($customer->nomor_telephone));
                            $this->info('Nomor Layanan : ' . $customer->nomor_layanan);
                            $this->info('==============================');
                        }
                    }
                }
            }

            // Notifikasi Tagihan 1 Hari Sebelum Jatuh Tempo
            if($has->id == 2){
                foreach ($customers as $customer) {
                    $due_date_one = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                    ->where('orders.customer_id', '=', $customer->id)
                    ->where('order_details.is_payed','=', 0)
                    ->first();

                    if($due_date_one != null){
                        $modif_due_date= Carbon::parse($due_date_one->due_date)->subDay(1)->format('Y-m-d');
                        if ($modif_due_date == $now) {
                            $banks = Bank::where('is_active', 1)->get();
                            $belum = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                                ->leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')
                                ->where('orders.customer_id', '=', $customer->id)
                                ->where('order_details.is_payed', 0)
                                ->sum('pakets.harga_paket');

                            // Mail::to($customer->user->email)->send(new OrderCreated($customer));

                            // Send WhatsApp message
                            $message = Setting::find(51);
                            // Replace <p> tags with newlines
                            $converted = preg_replace('/<p[^>]*>/', '', $message->value);
                            $converted = preg_replace('/<\/p>/', "\n\n", $converted);

                            // Remove <strong> tags
                            $converted = preg_replace('/<strong[^>]*>/', "*", $converted);
                            $converted = preg_replace('/<\/strong>/', "*", $converted);

                            // Remove <i> tags
                            $converted = preg_replace('/<i[^>]*>/', "_", $converted);
                            $converted = preg_replace('/<\/i>/', "_", $converted);

                            // Remove <br> tags
                            $converted = preg_replace('/<br[^>]*>/', "\n", $converted);
                            $converted = preg_replace('/&nbsp;/', '', $converted);

                            $converted = preg_replace('/%customer%/', $customer->nama_customer, $converted);
                            $converted = preg_replace('/%invoices%/', $due_date_one->invoice_number, $converted);
                            $converted = preg_replace('/%bulantahun%/', Carbon::parse($due_date_one->due_date)->format('F Y'), $converted);
                            $converted = preg_replace('/%nominaltagihan%/', "Rp ".number_format($belum, 0, ',', '.').",-", $converted);
                            $converted = preg_replace('/%jatuhtempo%/', Carbon::parse($due_date_one->due_date)->format('d F Y'), $converted);
                            $converted = preg_replace('/%bankmandiri%/',$banks[3]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%bankbca%/', $banks[2]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%bankbri%/', $banks[0]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%bankbni%/', $banks[1]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%linkurlpayment%/', $tripay_url, $converted);

                             // Nama Perusahaan dan Keterangan Lainnya
                            $aliasperusahaan = Setting::find(6);
                            $namaperusahaan = Setting::find(23);
                            $val1 = Setting::find(24);
                            $val2 = Setting::find(25);
                            $val3 = Setting::find(26);
                            $val4 = Setting::find(27);
                            $alamatperusahaan = ($val1->value.', '.$val2->value.', '.$val3->value.' - '.$val4->value);
                            $phone = Setting::find(29);
                            $phonealternate = Setting::find(19);
                            $urlperusahaan = Setting::find(20);

                            $converted = preg_replace('/%aliasperusahaan%/', $aliasperusahaan->value, $converted);
                            $converted = preg_replace('/%namaperusahaan%/', $namaperusahaan->value, $converted);
                            $converted = preg_replace('/%alamatperusahaan%/', $alamatperusahaan, $converted);
                            $converted = preg_replace('/%phone%/', $phone->value , $converted);
                            $converted = preg_replace('/%phonealternate%/', $phonealternate->value, $converted);
                            $converted = preg_replace('/%urlperusahaan%/', $urlperusahaan->value, $converted);

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
                                    'message' => $converted,
                                    'countryCode' => '62', //optional
                                ),
                                CURLOPT_HTTPHEADER => array(
                                    'Authorization: '.$set->value //change TOKEN to your actual token
                                ),
                            ));

                            $response = curl_exec($curl);
                            curl_close($curl);

                            $isi = json_decode($response, true);
                            if (isset($isi['detail']) && isset($isi['process'])) {
                                $this->info('==============================');
                                $this->info('Berhasil Mengirim WA -1 Jatuh Tempo : ' . $customer->nama_customer);
                                $this->info('Nomor Telephone : ' . convert_phone($customer->nomor_telephone));
                                $this->info('Nomor Layanan : ' . $customer->nomor_layanan);
                                $this->info('==============================');
                            }
                        }
                    }


                }
            }

            // Notifikasi Tagihan 3 Hari Sebelum Jatuh Tempo
            if($has->id == 3){
                foreach ($customers as $customer) {
                    $due_date_three = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                    ->where('orders.customer_id', '=', $customer->id)
                    ->where('order_details.is_payed','=', 0)
                    ->first();

                    if($due_date_three != null){
                        $modif_due_date= Carbon::parse($due_date_three->due_date)->subDay(3)->format('Y-m-d');

                        if ($modif_due_date == $now) {
                            $banks = Bank::where('is_active', 1)->get();
                            $belum = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                                ->leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')
                                ->where('orders.customer_id', '=', $customer->id)
                                ->where('order_details.is_payed', 0)
                                ->sum('pakets.harga_paket');

                            // Mail::to($customer->user->email)->send(new OrderCreated($customer));

                            // Send WhatsApp message
                            $message = Setting::find(51);
                            // Replace <p> tags with newlines
                            $converted = preg_replace('/<p[^>]*>/', '', $message->value);
                            $converted = preg_replace('/<\/p>/', "\n\n", $converted);

                            // Remove <strong> tags
                            $converted = preg_replace('/<strong[^>]*>/', "*", $converted);
                            $converted = preg_replace('/<\/strong>/', "*", $converted);

                            // Remove <i> tags
                            $converted = preg_replace('/<i[^>]*>/', "_", $converted);
                            $converted = preg_replace('/<\/i>/', "_", $converted);

                            // Remove <br> tags
                            $converted = preg_replace('/<br[^>]*>/', "\n", $converted);
                            $converted = preg_replace('/&nbsp;/', '', $converted);

                            $converted = preg_replace('/%customer%/', $customer->nama_customer, $converted);
                            $converted = preg_replace('/%invoices%/', $due_date_three->invoice_number, $converted);
                            $converted = preg_replace('/%bulantahun%/', Carbon::parse($due_date_three->due_date)->format('F Y'), $converted);
                            $converted = preg_replace('/%nominaltagihan%/', "Rp ".number_format($belum, 0, ',', '.').",-", $converted);
                            $converted = preg_replace('/%jatuhtempo%/', Carbon::parse($due_date_three->due_date)->format('d F Y'), $converted);
                            $converted = preg_replace('/%bankmandiri%/',$banks[3]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%bankbca%/', $banks[2]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%bankbri%/', $banks[0]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%bankbni%/', $banks[1]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%linkurlpayment%/', $tripay_url, $converted);

                             // Nama Perusahaan dan Keterangan Lainnya
                            $aliasperusahaan = Setting::find(6);
                            $namaperusahaan = Setting::find(23);
                            $val1 = Setting::find(24);
                            $val2 = Setting::find(25);
                            $val3 = Setting::find(26);
                            $val4 = Setting::find(27);
                            $alamatperusahaan = ($val1->value.', '.$val2->value.', '.$val3->value.' - '.$val4->value);
                            $phone = Setting::find(29);
                            $phonealternate = Setting::find(19);
                            $urlperusahaan = Setting::find(20);

                            $converted = preg_replace('/%aliasperusahaan%/', $aliasperusahaan->value, $converted);
                            $converted = preg_replace('/%namaperusahaan%/', $namaperusahaan->value, $converted);
                            $converted = preg_replace('/%alamatperusahaan%/', $alamatperusahaan, $converted);
                            $converted = preg_replace('/%phone%/', $phone->value , $converted);
                            $converted = preg_replace('/%phonealternate%/', $phonealternate->value, $converted);
                            $converted = preg_replace('/%urlperusahaan%/', $urlperusahaan->value, $converted);

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
                                    'message' => $converted,
                                    'countryCode' => '62', //optional
                                ),
                                CURLOPT_HTTPHEADER => array(
                                    'Authorization: '.$set->value //change TOKEN to your actual token
                                ),
                            ));

                            $response = curl_exec($curl);
                            curl_close($curl);

                            $isi = json_decode($response, true);
                            if (isset($isi['detail']) && isset($isi['process'])) {
                                $this->info('==============================');
                                $this->info('Berhasil Mengirim WA -3 Jatuh Tempo : ' . $customer->nama_customer);
                                $this->info('Nomor Telephone : ' . convert_phone($customer->nomor_telephone));
                                $this->info('Nomor Layanan : ' . $customer->nomor_layanan);
                                $this->info('==============================');
                            }
                        }
                    }


                }
            }

             // Notifikasi Tagihan 7 Hari Sebelum Jatuh Tempo
            if($has->id == 4){
                foreach ($customers as $customer) {
                    $due_date_seven = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                    ->where('orders.customer_id', '=', $customer->id)
                    ->where('order_details.is_payed','=', 0)
                    ->first();

                    if($due_date_seven != null){
                        $modif_due_date= Carbon::parse($due_date_seven->due_date)->subDay(7)->format('Y-m-d');

                        if ($modif_due_date == $now) {
                            $banks = Bank::where('is_active', 1)->get();
                            $belum = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                                ->leftJoin('pakets', 'pakets.id', '=', 'orders.paket_id')
                                ->where('orders.customer_id', '=', $customer->id)
                                ->where('order_details.is_payed', 0)
                                ->sum('pakets.harga_paket');

                            // Mail::to($customer->user->email)->send(new OrderCreated($customer));

                            // Send WhatsApp message
                            $message = Setting::find(51);
                            // Replace <p> tags with newlines
                            $converted = preg_replace('/<p[^>]*>/', '', $message->value);
                            $converted = preg_replace('/<\/p>/', "\n\n", $converted);

                            // Remove <strong> tags
                            $converted = preg_replace('/<strong[^>]*>/', "*", $converted);
                            $converted = preg_replace('/<\/strong>/', "*", $converted);

                            // Remove <i> tags
                            $converted = preg_replace('/<i[^>]*>/', "_", $converted);
                            $converted = preg_replace('/<\/i>/', "_", $converted);

                            // Remove <br> tags
                            $converted = preg_replace('/<br[^>]*>/', "\n", $converted);
                            $converted = preg_replace('/&nbsp;/', '', $converted);

                            $converted = preg_replace('/%customer%/', $customer->nama_customer, $converted);
                            $converted = preg_replace('/%invoices%/', $due_date_seven->invoice_number, $converted);
                            $converted = preg_replace('/%bulantahun%/', Carbon::parse($due_date_seven->due_date)->format('F Y'), $converted);
                            $converted = preg_replace('/%nominaltagihan%/', "Rp ".number_format($belum, 0, ',', '.').",-", $converted);
                            $converted = preg_replace('/%jatuhtempo%/', Carbon::parse($due_date_seven->due_date)->format('d F Y'), $converted);
                            $converted = preg_replace('/%bankmandiri%/',$banks[3]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%bankbca%/', $banks[2]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%bankbri%/', $banks[0]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%bankbni%/', $banks[1]['nomor_akun_rekening'], $converted);
                            $converted = preg_replace('/%linkurlpayment%/', $tripay_url, $converted);

                             // Nama Perusahaan dan Keterangan Lainnya
                            $aliasperusahaan = Setting::find(6);
                            $namaperusahaan = Setting::find(23);
                            $val1 = Setting::find(24);
                            $val2 = Setting::find(25);
                            $val3 = Setting::find(26);
                            $val4 = Setting::find(27);
                            $alamatperusahaan = ($val1->value.', '.$val2->value.', '.$val3->value.' - '.$val4->value);
                            $phone = Setting::find(29);
                            $phonealternate = Setting::find(19);
                            $urlperusahaan = Setting::find(20);

                            $converted = preg_replace('/%aliasperusahaan%/', $aliasperusahaan->value, $converted);
                            $converted = preg_replace('/%namaperusahaan%/', $namaperusahaan->value, $converted);
                            $converted = preg_replace('/%alamatperusahaan%/', $alamatperusahaan, $converted);
                            $converted = preg_replace('/%phone%/', $phone->value , $converted);
                            $converted = preg_replace('/%phonealternate%/', $phonealternate->value, $converted);
                            $converted = preg_replace('/%urlperusahaan%/', $urlperusahaan->value, $converted);

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
                                    'message' => $converted,
                                    'countryCode' => '62', //optional
                                ),
                                CURLOPT_HTTPHEADER => array(
                                    'Authorization: '.$set->value //change TOKEN to your actual token
                                ),
                            ));

                            $response = curl_exec($curl);
                            curl_close($curl);

                            $isi = json_decode($response, true);
                            if (isset($isi['detail']) && isset($isi['process'])) {
                                $this->info('==============================');
                                $this->info('Berhasil Mengirim WA -7 Jatuh Tempo : ' . $customer->nama_customer);
                                $this->info('Nomor Telephone : ' . convert_phone($customer->nomor_telephone));
                                $this->info('Nomor Layanan : ' . $customer->nomor_layanan);
                                $this->info('==============================');
                            }
                        }
                    }


                }
            }
        }
    }
}
