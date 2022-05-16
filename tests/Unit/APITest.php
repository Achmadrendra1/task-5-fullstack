<?php

namespace Tests\Unit;

use App\Models\Articles;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class APITest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_api_bisa_menampilkan_list_posts()
    {
        $faker = \Faker\Factory::create();
        $user = User::factory()->create();
        Passport::actingAs($user);
        Storage::fake('local');
        $image = UploadedFile::fake()->image('image.jpg', 1024);
        
       Articles::factory()->create([
            'title' => "Test List Post Di API",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
            'image' => $image
       ]);

        $this->json('get', '/api/v1/posts')->assertStatus(200);
    }

    public function test_api_bisa_menyimpan_posts()
    {
        $faker = \Faker\Factory::create();
        $user = User::factory()->create();
        Passport::actingAs($user);
        Storage::fake('local');
        $image = UploadedFile::fake()->image('image.jpg', 1024);

        $data = [
            'title' => "Test Simpan Post Di API",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
            'image' => $image,
            'user_id' => $user->id,
            'category_id' => \mt_rand(1,5)
        ];

        $this->json('post', '/api/v1/posts', $data)->assertStatus(201);
    }

    public function test_api_bisa_menampilkan_detail_posts()
    {
        $faker = \Faker\Factory::create();
        $user = User::factory()->create();
        Passport::actingAs($user);
        

        $article = Articles::factory()->create([
            'title' => "Test Detail Post Di API",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
        ]);

     

        $this->json('get', '/api/v1/posts/'. $article->id)->assertStatus(200);
    }

    public function test_api_bisa_mengupdate_posts()
    {
        $faker = \Faker\Factory::create();
        $user = User::factory()->create();
        Passport::actingAs($user);
        Storage::fake('local');
        $image = UploadedFile::fake()->image('image.jpg', 1024);
        $article = Articles::factory()->create([
            'title' => "Test Update Post Di API",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
        ]);

        $data = [
                'title' => "Test Update Post Di API (OK)",
                'content' => $faker->paragraph(4),
                'excerpt' => $faker->paragraph(1),
                'image' => $image,
                'user_id' => $user->id,
                'category_id' => \mt_rand(1, 5)
            ];


        $this->json('put', '/api/v1/posts/' . $article->id, $data)->assertStatus(200);
    }

    public function test_api_bisa_menghapus_posts()
    {
        $faker = \Faker\Factory::create();
        $user = User::factory()->create();
        Passport::actingAs($user);


        $article = Articles::factory()->create([
            'title' => "Test Hapus Post Di API",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
        ]);



        $this->json('delete', '/api/v1/posts/' . $article->id)->assertStatus(200);
    }


}
