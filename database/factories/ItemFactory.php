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
        /**
         *      Item::create([
            'name' => 'Chips',
            'description' => 'Chips yang enak',
            'price' => 3.000,
            'category_id' => 3,
        ]);
         */
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomNumber(6, 1, 100),
            'category_id' => $this->faker->numberBetween(1, 3),
            'stock' => $this->faker->numberBetween(1, 100),
            'supplier_id' => $this->faker->numberBetween(1, 2),
            'media_path' => $this->faker->image(public_path('images'), 640, 480, 'food', false),
        ];
    }
}
