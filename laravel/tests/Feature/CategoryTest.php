<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    // TC001: Get all categories
    public function test_can_get_all_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->get('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    // TC002: Create a category successfully
    public function test_can_create_category()
    {
        $data = ['name' => 'Electronics'];

        $response = $this->postJson('/api/categories', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Electronics']);

        $this->assertDatabaseHas('categories', $data);
    }

    // TC003: Creating a category without name should fail
    public function test_create_category_validation_error()
    {
        $response = $this->postJson('/api/categories', ['name' => '']);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    // TC004: Get a single category by ID
    public function test_can_get_single_category()
    {
        $category = Category::factory()->create();

        $response = $this->get("/api/categories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $category->name]);
    }

    // TC005: Getting a non-existent category should return 404
    public function test_get_nonexistent_category_returns_404()
    {
        $response = $this->get('/api/categories/9999');

        $response->assertStatus(404);
    }

    // TC006: Update an existing category
    public function test_can_update_category()
    {
        $category = Category::factory()->create(['name' => 'Old Name']);

        $response = $this->patchJson("/api/categories/{$category->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Updated Name']);
    }

    // TC007: Update with invalid name should return validation error
    public function test_update_category_validation_error()
    {
        $category = Category::factory()->create();

        $response = $this->patchJson("/api/categories/{$category->id}", [
            'name' => '',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }

    // TC008: Updating a non-existent category should return 404
    public function test_update_nonexistent_category_returns_404()
    {
        $response = $this->patchJson('/api/categories/9999', ['name' => 'New Name']);

        $response->assertStatus(404);
    }

    // TC009: Delete an existing category
    public function test_can_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Delete successful!']);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    // TC010: Deleting a non-existent category should return 404
    public function test_delete_nonexistent_category_returns_404()
    {
        $response = $this->deleteJson('/api/categories/9999');

        $response->assertStatus(404);
    }
}
