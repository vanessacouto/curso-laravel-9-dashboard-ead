<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
 */
class SupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $statusOptions = ['P', 'A', 'C'];
        shuffle($statusOptions); // embaralhao o array

        return [
            'id' => Str::uuid(),
            'user_id' => User::factory(),
            'lesson_id' => Lesson::factory(),
            'status' => $statusOptions[0],
            'description' => $this->faker->sentence(20),
        ];
    }
}
