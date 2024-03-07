<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "customer_id" => $this->faker->numberBetween(1, 10),
            "location_id" => $this->faker->numberBetween(1, 5),
            "paket_id" => $this->faker->numberBetween(1, 5),
            // "coordinates_id" => $this->faker->name(),
            "payment_id" => $this->faker->numberBetween(1, 3),
            "diskon" => $this->faker->numberBetween(1, 10),
            "biaya_pasang" => $this->faker->numberBetween(0, 100000),
            "path_ktp" => $this->faker->imageUrl($format = 'jpg'),
            "path_image_rumah" => $this->faker->imageUrl($format = 'jpg'),
            "order_date" => $this->faker->date(),
            "installed_date" => $this->faker->date(),
            "installed_image" => $this->faker->imageUrl($format = 'jpg'),
            "installed_status" => $this->faker->numberBetween(0,1),
            "due_date" => $this->faker->unique()->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = null),
        ];
    }
}
