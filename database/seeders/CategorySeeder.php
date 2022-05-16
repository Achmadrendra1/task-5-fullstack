<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Categories::truncate();

        $faker = \Faker\Factory::create();


        for ($i = 0; $i < 5; $i++) {

            Categories::create([
                'name' => $faker->sentence(\mt_rand(1, 2)),
                'user_id' => \mt_rand(1, 10),

            ]);
        }
    }
}
