<?php

namespace App\Console\Commands;

use App\Mail\OrderCreated;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function App\Http\Helpers\convert_phone;

class Tagihan extends Command
{
    protected $signature = 'make:tagihan';
    protected $description = 'Create Tagihan To Customer Bulan Berjalan';

    public function handle()
    {
        $customers = Customer::where('is_active', 1)->get();

        foreach ($customers as $customer) {
            $first = Carbon::now()->addMonth(1)->firstOfMonth()->format('Y-m-d');
            $last = Carbon::now()->addMonth(1)->lastOfMonth()->format('Y-m-d');

            $count = OrderDetail::leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                ->where('orders.customer_id', '=', $customer->id)
                ->whereBetween('due_date', [$first, $last])
                ->orderBy('order_id', 'DESC')
                ->groupBy('orders.customer_id', 'due_date', 'order_details.id')
                ->count();

                // dd($count);
            if ($count == 0) {
                $orderDetail = OrderDetail::select('order_details.payment_id', 'order_details.due_date', 'orders.id',)
                    ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                    ->where('orders.customer_id', '=', $customer->id)
                    ->orderBy('order_details.order_id', 'DESC')
                    ->groupBy(
                        'orders.customer_id',
                        'orders.id',
                        'order_details.due_date',
                        'order_details.payment_id'
                    )
                    ->first();

                $newDueDate = Carbon::parse($orderDetail->due_date)->addMonth(1)->format('Y-m-d');

                OrderDetail::create([
                    'due_date' => $newDueDate,
                    'payment_id' => $orderDetail->payment_id,
                    'order_id' => $orderDetail->id,
                    'invoice_number' => 'INV' . rand(11111111, 99999999),
                    'uuid' => Str::uuid(64),
                ]);

                $this->info('==============================');
                $this->info('Berhasil Buat Tagihan atas Nama : ' . $customer->nama_customer);
                $this->info('Nomor Telephone : ' . convert_phone($customer->nomor_telephone));
                $this->info('Nomor Pelanggan : ' . $customer->nomor_layanan);
                $this->info('==============================');
            } else {
                $this->warn('==============================');
                $this->warn('Sudah ada tagihan customer : ' . $customer->nama_customer);
                $this->warn('Nomor Telephone : ' . convert_phone($customer->nomor_telephone));
                $this->warn('Nomor Pelanggan : ' . $customer->nomor_layanan);
                $this->warn('==============================');
            }
        }
    }
}
