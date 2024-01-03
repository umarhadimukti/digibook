<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(3, 6)),
            'slug' => $this->faker->unique()->slug(mt_rand(4, 6)),
            'description' => collect($this->faker->paragraphs(mt_rand(10, 20)))->implode(""),
            'cover' => $this->faker->imageUrl(600, 900, 'books', true),
            'book' => $this->faker->word() . '.pdf',
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'user_id' => $this->faker->numberBetween(1, 30),
            'category_id' => $this->faker->numberBetween(1, 6),
        ];
    }
}
