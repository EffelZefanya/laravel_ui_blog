<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_see_their_categories(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/yourCategories');

        $response->assertStatus(200);
    }

    public function test_user_can_create_a_category(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $categoryData = [
            "name" => fake()->sentence(),
        ];

        $response = $this->post('/addCategory', $categoryData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('categories', $categoryData);
    }

    public function test_user_can_delete_a_category(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::create([
            "name" => fake()->sentence(),
        ]);

        $this->assertDatabaseHas('categories', $category);

        $response = $this->delete("/deleteCategory/{$category->id}");

        $response->assertStatus(302);

        $this->assertDatabaseMissing('categories', $category->toArray());
    }

    public function test_user_can_update_a_category(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::create([
            "name" => fake()->sentence(),
        ]);

        $this->assertDatabaseHas('categories', $category->toArray());

        $updatedCategoryData = [
            'name' => 'Updated Category',
        ];

        $response = $this->put("/updateCategory/{$category->id}", $updatedCategoryData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('categories', $updatedCategoryData);
    }
}
