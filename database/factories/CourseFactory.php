<?php

namespace Database\Factories;

use App\Models\Platform;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->sentence,
            'slug' => fake()->slug,
            'type'  => rand(0, 1),
            'resources' => rand(1, 5),
            'year' => rand(2011,2022),
            'price' => rand(0, 10000) / 100,
            'description' => fake()->paragraph,
            'submitted_by' => User::all()->random()->id, // Assumes there are 50 users in the users table
            'link' => fake()->url(),
            'duration' => rand(0,2),
            'level'=>rand(0,2),
            'platform_id' => Platform::all()->random()->id, // Assumes there are 10 platforms in the platforms table
            'image' => fake()->imageUrl(),
        ];
    }
}

