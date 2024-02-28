<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meta_description' => $this->faker->sentence(6,  true),
            'meta_keywords' => implode(',', $this->faker->words($nb = 3, $asText = false)),
            'excerpt' => $this->faker->paragraph(4, true),
            'body' => $this->faker->paragraphs(8,  true),
            'active' => true
        ];
    }
}
