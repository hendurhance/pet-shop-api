<?php

namespace Tests\Feature\Product;

use App\Actions\Auth\AuthAction;
use App\Models\Brand;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $jwtToken;

    private $brands;

    private $images;

    private $categories;

    private $products;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->user()->create();
        $this->jwtToken = (new AuthAction())->authenticate([
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->categories = Category::factory()->count(3)->create();
        $this->brands = Brand::factory()->count(3)->create();
        $this->images = File::factory()->count(3)->create();
        $this->products = Product::factory()->count(5)->create();
    }

    /**
     * Test list all products works.
     * @return void
     */
    public function test_list_all_products_works()
    {
        $response = $this->json('GET', route('api.v1.product.index'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'title' => $this->products[0]->title,
            'description' => $this->products[0]->description,
            'price' => $this->products[0]->price
        ]);
    }

    /**
     * Test show product works.
     * @return void
     */
    public function test_show_product_works()
    {
        $response = $this->json('GET', route('api.v1.product.show', $this->products[0]->uuid));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'title' => $this->products[0]->title,
            'description' => $this->products[0]->description,
            'price' => $this->products[0]->price
        ]);
    }

    /**
     * Test create product works.
     * @return void
     */
    public function test_create_product_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.product.create'), [
            'category_uuid' => $this->categories[0]->uuid,
            'title' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100,
            'metadata' => [
                'image' => $this->images[0]->uuid,
                'brand' => $this->brands[0]->uuid
            ]
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJsonFragment([
            'title' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100
        ]);

        $this->assertDatabaseHas('products', [
            'title' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100
        ]);
    }

    /**
     * Test create product fails with invalid data.
     * @return void
     */
    public function test_create_product_fails_with_invalid_data()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.product.create'), [
            'category_uuid' => $this->categories[0]->uuid,
            'title' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 'test',
            'metadata' => [
                'image' => $this->images[0]->uuid,
                'brand' => $this->brands[0]->uuid
            ]
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonFragment([
            'price' => [
                'The price field must be a number.'
            ]
        ]);
    }

    /**
     * Test update product works.
     * @return void
     */
    public function test_update_product_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('PUT', route('api.v1.product.update', $this->products[0]->uuid), [
            'category_uuid' => $this->categories[0]->uuid,
            'title' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100,
            'metadata' => [
                'image' => $this->images[0]->uuid,
                'brand' => $this->brands[0]->uuid
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'title' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100
        ]);

        $this->assertDatabaseHas('products', [
            'title' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100
        ]);
    }

    /**
     * Test soft delete product works.
     * @return void
     */
    public function test_soft_delete_product_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('DELETE', route('api.v1.product.destroy', $this->products[0]->uuid));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertSoftDeleted('products', [
            'uuid' => $this->products[0]->uuid
        ]);
    }
}
