<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    // TC001: Get all products
    public function test_can_get_all_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->get('/api/products');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    // TC002: Create product successfully
    public function test_can_create_product()
    {
        $category = Category::factory()->create();

        $data = [
            'name' => 'Laptop',
            'pricing' => 1200,
            'description' => 'High-end gaming laptop',
            'category_id' => $category->id,
        ];

        $response = $this->postJson('/api/products', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Laptop']);

        $this->assertDatabaseHas('products', ['name' => 'Laptop']);
    }

    // TC003: Creating product with missing fields should fail
    public function test_create_product_validation_error()
    {
        $response = $this->postJson('/api/products', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'pricing', 'category_id']);
    }

    // TC004: Creating product with non-existent category should fail
    public function test_create_product_with_invalid_category()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Phone',
            'pricing' => 500,
            'description' => 'Smartphone',
            'category_id' => 9999,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['category_id']);
    }

    // TC005: Get a single product
    public function test_can_get_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->get("/api/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $product->name]);
    }

    // TC006: Get non-existent product returns 404
    public function test_get_nonexistent_product_returns_404()
    {
        $response = $this->get('/api/products/9999');

        $response->assertStatus(404);
    }

    // TC007: Update a product successfully
    public function test_can_update_product()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();

        $response = $this->patchJson("/api/products/{$product->id}", [
            'name' => 'Updated Name',
            'pricing' => 999.99,
            'description' => 'Updated description',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Updated Name']);
    }

    // TC008: Update with invalid category should fail
    public function test_update_product_with_invalid_category()
    {
        $product = Product::factory()->create();

        $response = $this->patchJson("/api/products/{$product->id}", [
            'name' => 'Name',
            'pricing' => 100,
            'description' => 'Desc',
            'category_id' => 9999,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['category_id']);
    }

    // TC009: Update non-existent product returns 404
    public function test_update_nonexistent_product_returns_404()
    {
        $category = Category::factory()->create();

        $response = $this->patchJson('/api/products/9999', [
            'name' => 'Nonexistent',
            'pricing' => 10,
            'description' => 'Test',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(404);
    }

    // TC010: Delete a product successfully
    public function test_can_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Delete successful!']);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    // TC011: Delete non-existent product returns 404
    public function test_delete_nonexistent_product_returns_404()
    {
        $response = $this->deleteJson('/api/products/9999');

        $response->assertStatus(404);
    }
}
