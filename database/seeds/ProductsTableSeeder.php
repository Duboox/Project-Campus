<?php

use Illuminate\Database\Seeder;
use Faker\Factory; // Faker
use App\Product; // DB Model

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create(); // Create a instance of the faker/factory

        foreach (range(1, 20) as $i) {
            Product::create([
                'name' => $faker->firstName,
                'model' => $faker->ean8,
                'serial_number' => $faker->ean8,
                'internal_code' => $faker->ean8,
                'magnitude' => mt_rand(1, 10),
                'date_last_calibration' => '2018-'.mt_rand(1, 12).'-'.mt_rand(1, 28), // Math Random
                'date_control_calibration' => '2018-'.mt_rand(1, 12).'-'.mt_rand(1, 28), // Math Random
                'delivery_status' => $faker->numberBetween(0, 1),
                'status' => $faker->numberBetween(0, 1),
                'id_fabricator' => App\Fabricator::all()->random()->id,
                'id_user' => App\User::all()->random()->id,
            ]);
        }
    }
}
