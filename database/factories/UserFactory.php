<?php

namespace Database\Factories;

use App\Models\User;
use File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Storage;
use Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $phoneBody = sprintf("%09d", mt_rand(0, 999999999));

        $image = fake()->image(format: 'jpg');
        $imageName = Str::random(30) . '.jpg';
        Storage::disk('media')->put($imageName, File::get($image));

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => "+380" . $phoneBody,

            'photo' => $imageName,
        ];
    }

}
