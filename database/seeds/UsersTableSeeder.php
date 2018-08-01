<?php

use Illuminate\Database\Seeder;
use Faker\Factory; // Faker
use App\User; // DB Model

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create(); // Create a instance of the faker/factory

        static $password;
        foreach (range(1, 5) as $i) {
            User::create([
                'name' => $faker->name,
                'last_name' => 'Pullok',
                'email' => $faker->unique()->safeEmail,
                'password' => $password ?: $password = bcrypt('secret'),
                'remember_token' => str_random(10),
            ]);
        }
    }
}
