<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'  =>fake()->sentence,
            'image'     => fake()->imageUrl(300,300),
            'twitterLink' => fake()->url(),
            'githubLink'    => fake()->url(),
            'description'   =>fake()->paragraph
        ];
    }
}
