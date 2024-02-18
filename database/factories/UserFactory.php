<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $phoneBody = sprintf("%09d", mt_rand(0, 999999999));

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => "+380" . $phoneBody,

            //TODO Fix this
            'photo' => "test photo url",
        ];
    }

}
