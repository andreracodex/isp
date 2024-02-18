<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nama_customer" => $this->faker->name(),
            "nomor_layanan" => $this->faker->phoneNumber,
            "location_id" => $this->faker->numberBetween(1, 5),
            "paket_id" => $this->faker->numberBetween(1, 5),
            "ip_config" => $this->faker->numberBetween(1, 5),
            "gender" => $this->faker->randomElement([
                "male",
                "female",
                "others"
            ]),
            "alamat_customer" => $this->faker->address,
            "kecamatan_customer" => $this->faker->address,
            "desa_customer" => $this->faker->address,
            "kodepos_customer" => $this->faker->postcode,
            "nomor_telephone" => $this->faker->phoneNumber
        ];
    }
}
