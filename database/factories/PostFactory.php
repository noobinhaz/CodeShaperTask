<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
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
    public function definition()
    {
        return [
            //
            'title' => fake()->sentence(), 
            'description' => fake()->paragraph(5),
            'image' => fake()->imageUrl($width = 640, $height = 480),
            'schedule' => date('Y-m-d H:i'),
            'created_by' => User::inRandomOrder()->value('id')
        ];
    }
}
