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
            "user_id" => $this->faker->numberBetween(1, 3),
            "nama_customer" => $this->faker->name(),
            "nomor_layanan" => $this->faker->randomNumber(),
            "nomor_ktp" => $this->faker->randomNumber(),
            "ip_config" => $this->faker->numberBetween(1, 5),
            "gender" => $this->faker->randomElement([
                "male",
                "female",
                "others"
            ]),
            "alamat_customer" => $this->faker->address,
            "kelurahan_id" => 3510011001,
            "kodepos_customer" => $this->faker->postcode,
            "nomor_telephone" => $this->faker->phoneNumber
        ];
    }

}
