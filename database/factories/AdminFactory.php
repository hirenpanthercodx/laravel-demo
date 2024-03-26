<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstName' => Str::random(10),
            'lastName' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'gender' => 'male',
            'occupation' => 'business',
            'hobby' => '["reading", "music"]',
            'created_at' => '2024-03-21 10:09:28'
        ];
    }
}
