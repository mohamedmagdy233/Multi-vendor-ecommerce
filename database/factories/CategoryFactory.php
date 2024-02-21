<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
//            'parent_id' => null,
//            'name' => $this->faker->word,
//            'slug' => $this->faker->slug,
//            'description' => $this->faker->sentence,
//            'image' => $this->faker->imageUrl(),
//            'status' => $this->faker->randomElement(['active', 'archived']),
        ];
    }
}
