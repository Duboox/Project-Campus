<?php

use Illuminate\Database\Seeder;
use Faker\Factory; // Faker
use App\Fabricator; // DB Model

class FabricatorsTableSeeder extends Seeder
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
            Fabricator::create([
                'name' => $faker->company,
                'description' => $faker->company,
                'id_user' => App\User::all()->random()->id,
            ]);
        }
    }
}
