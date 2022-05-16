<?php

namespace Database\Seeders;

use App\Models\Articles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Articles::truncate();

        $faker = \Faker\Factory::create();


        for ($i = 0; $i < 50; $i++) {

            Articles::create([
                'title' => $faker->sentence,
                'slug' => $faker->slug(),
                'content' => $faker->paragraph(\mt_rand(5, 10)),
                'excerpt' => $faker->paragraph(\mt_rand(1, 2)),
                'user_id' => \mt_rand(1, 10),
                'category_id' => \mt_rand(1, 5)
            ]);
        }
    }
}
