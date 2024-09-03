<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(5),
            'published_at' => $this->faker->dateTimeBetween(
                startDate: '-1 year',
                endDate: 'now'
            ),
        ];
    }
}
