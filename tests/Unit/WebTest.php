<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Articles;
use App\Models\Categories;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class WebTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_web_bisa_lihat_halaman_awal()
    {
        $this->get('/')->assertSee('Simple Blog | Home')->assertStatus(200);
    }

    public function test_web_bisa_lihat_halaman_login()
    {
        $this->get('/login')->assertSee('Simple Blog')->assertStatus(200);
    }

    public function test_web_bisa_lihat_halaman_register()
    {
        $this->get('/register')->assertSee('Simple Blog')->assertStatus(200);
    }

    public function test_web_bisa_lihat_pencarian_post()
    {
        $faker = \Faker\Factory::create();
        $article = Articles::factory()->create([
            'title' => "Test Pencarian Post",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
        ]);

        $this->get('/?search='.$article->title)->assertStatus(200);
    }

    public function test_web_bisa_lihat_detail_post()
    {
        $faker = \Faker\Factory::create();
        $user = User::factory()->create();
        Passport::actingAs($user);
        $article = Articles::factory()->create([
            'title' => "Test Detail Post",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
        ]);

        $this->get('article/' . $article->slug)->assertSee('Simple Blog | Detail Post')->assertStatus(200);
    }

    public function test_web_admin_bisa_lihat_halaman_admin()
    {
        $faker = \Faker\Factory::create();
        $password = Hash::make('password1@');
        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $password,
            'is_admin' => 1

        ]);
        Passport::actingAs($user);
     
        $this->get('/admin')->assertSee('Dashboard')->assertStatus(200);
    
    }

    public function test_web_admin_bisa_lihat_halaman_my_post()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $this->get('/admin/posts')->assertSee('My Post')->assertStatus(200);
    }

    public function test_web_admin_bisa_lihat_halaman_tambah_post()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $this->get('/admin/posts/add-post')->assertSee('Add New Post')->assertStatus(200);
    }

    public function test_web_admin_bisa_menyimpan_post()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $faker = \Faker\Factory::create();
        Storage::fake('local');
        $image = UploadedFile::fake()->image('image.jpg', 1024);

        $data = [
            'title' => "Test Simpan Post",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
            'image' => $image,
            'user_id' => $user->id,
            'category' => \mt_rand(1, 5)
        ];

        $this->post('/admin/posts/addposts', $data)->assertRedirect('/admin/posts')->assertStatus(302);
    }

    public function test_web_admin_bisa_lihat_halaman_edit_post()
    {
        $faker = \Faker\Factory::create();
        $user = User::factory()->create();
        Passport::actingAs($user);
        $article = Articles::factory()->create([
            'title' => "Test Edit Post",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
        ]);

        $this->get('/admin/posts/edit/' . $article->id)->assertSee('Edit Post')->assertStatus(200);
    }

    public function test_web_admin_bisa_update_post()
    {
        $faker = \Faker\Factory::create();
        Storage::fake('local');
        $image = UploadedFile::fake()->image('image.jpg', 1024);
        $user = User::factory()->create();
        Passport::actingAs($user);
        $article = Articles::factory()->create([
            'title' => "Test Update Post",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
        ]);

        $data = [
            'edited_title' => "Test Update Post(OK)",
            'edited_content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
            'image' => $image,
            'user_id' => $user->id,
            'category' => \mt_rand(1, 5)
        ];

        $this->post('/admin/posts/update/' . $article->id, $data)->assertRedirect('/admin/posts')->assertStatus(302);
    }

    public function test_web_admin_bisa_menghapus_post()
    {
        $faker = \Faker\Factory::create();
        $user = User::factory()->create();
        Passport::actingAs($user);
        $article = Articles::factory()->create([
            'title' => "Test Hapus Post",
            'content' => $faker->paragraph(4),
            'excerpt' => $faker->paragraph(1),
        ]);

        $this->get('/admin/posts/destroy/' . $article->id)->assertRedirect('/admin/posts')->assertStatus(302);
    }

    public function test_web_admin_bisa_lihat_halaman_category()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $this->get('/admin/category')->assertSee('List Category')->assertStatus(200);
    }

    public function test_web_admin_bisa_lihat_halaman_tambah_category()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $this->get('/admin/category/add-category')->assertSee('Add New Category')->assertStatus(200);
    }

    public function test_web_admin_bisa_menyimpan_category()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $faker = \Faker\Factory::create();
        

        $data = [
            'name' => $faker->sentence(1),
            'user_id' => $user->id,
            
        ];

        $this->post('/admin/category/addcategory', $data)->assertRedirect('/admin/category')->assertStatus(302);
    }

    public function test_web_admin_bisa_lihat_halaman_edit_category()
    {
     
        $user = User::factory()->create();
        Passport::actingAs($user);
        $category = Categories::factory()->create();

        $this->get('/admin/posts/edit/' . $category->id)->assertSee('Edit Post')->assertStatus(200);
    }

    public function test_web_admin_bisa_update_category()
    {
      
        $user = User::factory()->create();
        Passport::actingAs($user);
        $category = Categories::factory()->create();

        $data = [
            'edited_name' => "Test Update Category",
           
        ];

        $this->post('/admin/category/update/' . $category->id, $data)->assertRedirect('/admin/category')->assertStatus(302);
    }

    public function test_web_admin_bisa_menghapus_category()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $category = Categories::factory()->create();

        $this->get('/admin/category/destroy/' . $category->id)->assertRedirect('/admin/category')->assertStatus(302);
    }

}
