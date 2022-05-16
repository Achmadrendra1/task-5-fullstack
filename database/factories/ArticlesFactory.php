<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Articles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ArticlesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Articles::class;

    public function definition()
    {
        Storage::fake('avatar');
        $image = UploadedFile::fake()->image('avatar.jpg', 1024);
        return [
            //

            'title' => $this->faker->sentence(1),
            'content' => $this->faker->text,
            'image' => $image,
            'user_id' => \mt_rand(1, 10),
            'category_id' => \mt_rand(1, 5)
        ];
    }
}
