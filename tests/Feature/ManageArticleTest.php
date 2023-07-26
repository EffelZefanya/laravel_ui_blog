<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ManageArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_all_article()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/allArticle');

        $response->assertStatus(200);
    }

    public function test_user_can_create_an_article()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category =Category::create([
            "name" => fake()->sentence(),
        ]);

        $articleData = [
            'title' => 'Test Article',
            'content' => 'This is a test article\'s content',
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'category_id' => $category->name,
        ];

        $response = $this->post('/addArticle', $articleData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('articles', $articleData);
    }
    public function test_user_can_delete_an_article()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::create([
            "name" => fake()->sentence(),
        ]);

        $article = Article::create([
            'title' => 'Test Article',
            'content' => 'This is a test article\'s content',
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'category_id' => $category->name,
        ]);

        $this->assertDatabaseHas('articles', $article);

        $response = $this->delete("/deleteArticle/{$article->id}");

        $response->assertStatus(302);

        $this->assertDatabaseMissing('articles', $article);
    }

    public function test_user_can_edit_an_article()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::create([
            "name" => fake()->sentence(),
        ]);

        $article = Article::create([
            'title' => 'Test Article',
            'content' => 'This is a test article\'s content',
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'category_id' => $category->id, // Use the category ID here, not the name
        ]);

        $this->assertDatabaseHas('articles', $article);

        $newArticleData = [
            'title' => 'Edited Article',
            'content' => 'This is an edited article\'s content',
            'image' => UploadedFile::fake()->image('edited_image.jpg'),
            'category_id' => $category->id, // Use the category ID here, not the name
        ];

        $response = $this->put("/updateArticle/{$article->id}", $newArticleData);

        $response->assertStatus(302);

        // Ensure the article in the database is updated with the new data
        $this->assertDatabaseHas('articles', $newArticleData);
    }
}
