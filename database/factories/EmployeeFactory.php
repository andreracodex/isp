<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            "user_id" => 2,
            "nama_karyawan" => $this->faker->name(),
            "nomor_ktp" => $this->faker->randomNumber(),
            "ip_config" => $this->faker->numberBetween(1, 5),
            "gender" => $this->faker->randomElement([
                "1",
                "2",
            ]),
            "gaji_pokok" => $this->faker->numberBetween(1000000, 3000000),
            "alamat_karyawan" => $this->faker->address,
            "kelurahan_id" => 3510011001,
            "kodepos_karyawan" => $this->faker->postcode,
            "nomor_telephone" => $this->faker->phoneNumber
        ];
    }
}
