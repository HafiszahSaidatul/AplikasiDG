<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'namaproduk' => $this->faker->sentence(mt_rand(1, 3)),
            'harga' => $this->faker->numberBetween(12000, 100000),
            'keterangan' => $this->faker->paragraphs(2, 5),
            'user_id' => mt_rand(1, 3),
        ];
    }
}
