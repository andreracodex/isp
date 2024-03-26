<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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
            ]);

            // Create order record if 'paket' and 'location' are provided
            if ($row->has('paket') && $row->has('location')) {
                $order = Order::create([
                    'customer_id' => $customer->id,
                    'paket_id' => $row['paket'],
                    'location_id' => $row['location'],
                    'installed_date' => $row['installed_date'],
                ]);
            }
        }
    }
}
