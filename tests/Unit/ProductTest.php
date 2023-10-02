<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use \Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

    public function testCreateProduct()
    {
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 9.99,
            'stock' => 5
        ]);

        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals(9.99, $product->price);
        $this->assertEquals(5, $product->stock);
    }

    public function testUpdateProduct()
    {
        $product = Product::factory()->create([
            'name' => 'Initial Product',
            'price' => 10.00,
            'stock' => 20
        ]);

        $product->update([
            'name' => 'Updated Product',
            'price' => 19.99,
            'stock' => 10
        ]);

        $this->assertEquals('Updated Product', $product->name);
        $this->assertEquals(19.99, $product->price);
        $this->assertEquals(10, $product->stock);
    }

    public function testDeleteProduct()
    {
        $product = Product::factory()->create([
            'name' => 'Product to Delete',
            'price' => 15.00,
            'stock' => 5
        ]);

        $product->delete();

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}