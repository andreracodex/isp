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
            "nama_karyawan" => $this->faker->name(),
            "ip_config" => $this->faker->numberBetween(1, 5),
            "gender" => $this->faker->randomElement([
                "male",
                "female",
            ]),
            "alamat_karyawan" => $this->faker->address,
            "kecamatan_karyawan" => $this->faker->address,
            "desa_karyawan" => $this->faker->address,
            "kodepos_karyawan" => $this->faker->postcode,
            "nomor_telephone" => $this->faker->phoneNumber
        ];
    }
}
