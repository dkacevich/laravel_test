<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Position;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $positions = Position::factory(5)->create();


        $userCount = 50;
        $userData = [];
        for ($i = 0; $i < $userCount; $i++) {
            $userData[] = User::factory()
                ->makeOne([
                    'position_id' => $positions->random()->id
                ])
                ->toArray();
        }


        DB::table('users')->insert($userData);
    }
}
