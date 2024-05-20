<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Collection;
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
                'gender' => 'required', // Adjust validation rules as per your requirements
                'nomor_ktp' => 'required',
                'alamat_customer' => 'required',
                'kodepos_customer' => 'required',
                'nomor_telephone' => 'required',
                'paket' => 'nullable', // Assuming 'paket' and 'location' are optional fields
                'location' => 'nullable',
                'installed_date' => 'nullable|date',
                'email' => 'required|email:dns|unique:users',
                'is_ppn' => 'required',
            ]);

            // If validation fails for any required fields, skip the row
            if ($validator->fails()) {
                continue;
            }

            // strip out all whitespace
            $username = preg_replace('/\s*/', '', $row['nama_customer']);
            // convert the string to all lowercase
            $username = strtolower($username);

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
                'kelurahan_id' => 3578180003,
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
            // Generate a random number between 1111 and 9999
            $randomNumber = rand(1111, 9999);
            // Concatenate the current year, date, and random number to create the invoice number
            $invoiceNumber = 'INV' . $currentYear . $randomNumber;
            OrderDetail::create([
                'order_id' => $order->id,
                'due_date' => $row['due_date'],
                'is_active' => 1,
                'is_payed' => 1,
                'invoice_number' => $invoiceNumber,
                'uuid' => Str::uuid(64),
                'ppn' => $row['is_ppn'],
            ]);
        }
    }
}
