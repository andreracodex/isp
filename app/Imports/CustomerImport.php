<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class CustomerImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Validate the row data
            $validator = validator($row->toArray(), [
                'nama_customer' => 'required',
                'gender' => 'required',
                'nomor_ktp' => 'required',
                'alamat_customer' => 'required',
                'kodepos_customer' => 'required',
                'nomor_telephone' => 'required',
                'paket' => 'nullable',
                'location' => 'nullable',
                'installed_date' => 'nullable|date',
                'email' => 'required|email:dns|unique:users',
                'is_ppn' => 'required',
            ]);

            // If validation fails for any required fields, skip the row
            if ($validator->fails()) {
                // Optionally log the errors
                Log::info('Validation failed for row: ', $validator->errors()->all());
                continue;
            }

            // Strip out all whitespace and convert the string to lowercase
            $username = strtolower(preg_replace('/\s*/', '', $row['nama_customer']));

            $user = User::create([
                'name' => $row['nama_customer'],
                'user_name' => $username,
                'email' => $row['email'],
                'password' => bcrypt('12345678'),
            ]);

            // Create customer record
            $customer = Customer::create([
                'user_id' => $user->id,
                'nama_customer' => $row['nama_customer'],
                'gender' => $row['gender'],
                'nomor_layanan' => mt_rand(10000000, 99999999),
                'nomor_ktp' => $row['nomor_ktp'],
                'alamat_customer' => $row['alamat_customer'],
                'kodepos_customer' => $row['kodepos_customer'],
                'kelurahan_id' => 3578180003, // This value might need to be dynamic
                'nomor_telephone' => $row['nomor_telephone'],
                'is_ppn' => $row['is_ppn'],
            ]);

            // Create order record if 'paket' and 'location' are provided
            $order = Order::create([
                'customer_id' => $customer->id,
                'location_id' => $row['location'],
                'paket_id' => $row['paket'],
                'installed_date' => $row['installed_date'],
                'installed_status' => 1,
                'biaya_pasang' => 0,
            ]);

            $currentYear = date('Y');
            $randomNumber = rand(1111, 9999);
            $invoiceNumber = 'INV' . $currentYear . $randomNumber;

            OrderDetail::create([
                'order_id' => $order->id,
                'due_date' => $row['due_date'],
                'is_active' => 1,
                'is_payed' => 1,
                'invoice_number' => $invoiceNumber,
                'uuid' => Str::uuid(),
                'ppn' => $row['is_ppn'],
            ]);
        }
    }
}
