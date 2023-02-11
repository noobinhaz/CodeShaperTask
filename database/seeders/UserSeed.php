<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserType;
use App\Models\User;

class UserSeed extends Seeder
{

    public function UserFindOrCreate(){
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $users = [
            ['name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'user_type' => fake()->randomElement([UserType::FREE, UserType::PREMIUM])],

            ['name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'user_type' => fake()->randomElement([UserType::FREE, UserType::PREMIUM])],

            ['name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'user_type' => fake()->randomElement([UserType::FREE, UserType::PREMIUM])],

            ['name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'user_type' => fake()->randomElement([UserType::FREE, UserType::PREMIUM])],

            ['name' => "SuperAdmin",
            'email' => "ahmedminhaz17@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'user_type' => fake()->randomElement([UserType::ADMIN])],
        ];

        User::truncate()->insert($users);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->UserFindOrCreate();
    }
}
