<?php

use Illuminate\Database\Seeder;
use Faker\Factory; // Faker
use App\Service; // DB Model

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create(); // Create a instance of the faker/factory

        foreach (range(1, 10) as $i) {
            Service::create([
                'date_entry' => '2018-'.mt_rand(1, 12).'-'.mt_rand(1, 28), // Math Random
                'date_return' => '2018-'.mt_rand(1, 12).'-'.mt_rand(1, 28), // Math Random
                'observation' => $faker->address,
                'id_client' => App\Client::all()->random()->id,
                'id_product' => App\Product::all()->random()->id,
                'id_user' => App\User::all()->random()->id,
            ]);
        }
    }
}
