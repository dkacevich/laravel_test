<?php

namespace Database\Factories;

use App\Models\AccessToken;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<AccessToken>
 */
class AccessTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payload' => Str::random(60),
            'created_at' => now()
        ];
    }
}
