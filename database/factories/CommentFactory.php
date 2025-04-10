<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $counter = Teacher::count();

        return [
            'teacher_id' => fake()->numberBetween(1, $counter),
            'text_comment' => fake()->sentence(),
            'remember_token' => Str::random(50)
        ];
    }
}
