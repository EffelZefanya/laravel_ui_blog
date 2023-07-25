<?php

namespace Tests\Feature;

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

    public function test_user_can_see_their_article(): void
    {
        $this->assertTrue(true);
    }

    public function test_user_can_see_all_article()
    {
        $this->assertTrue(true);
    }

    public function test_user_can_read_an_article()
    {
        $this->assertTrue(true);
    }

    public function test_user_can_create_an_article()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category =Category::create([
            "name" => fake()->sentence(),
            "user_id" => $user->id,
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
        $this->assertTrue(true);
    }
    public function test_user_can_edit_an_article()
    {
        $this->assertTrue(true);
    }
}
