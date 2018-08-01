<?php

use Illuminate\Database\Seeder;
use Faker\Factory; // Faker
use App\Client; // DB Model

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create(); // Create a instance of the faker/factory

        foreach (range(1, 5) as $i) {
            Client::create([
                'name' => $faker->name,
                'last_name' => 'Pullok',
                'city' => $faker->city,
                'residency' => $faker->address,
                'phone' => $faker->tollFreePhoneNumber,
                'fax' => $faker->tollFreePhoneNumber,
                'email' => $faker->safeEmail,
                'id_user' => App\User::all()->random()->id,
            ]);
        }
    }
}
