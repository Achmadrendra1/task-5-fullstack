<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Categories::class;
    public function definition()
    {
        return [
            //
            'name' => $this->faker->sentence,
            'user_id' => \mt_rand(1, 10)
        ];
    }
}
