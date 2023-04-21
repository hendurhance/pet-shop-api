<?php

namespace Tests\Feature\Brand;

use App\Actions\Auth\AuthAction;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $jwtToken;

    private $brand;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->user()->create();
        $this->jwtToken = (new AuthAction())->authenticate([
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->brand = Brand::factory()->create();
    }

    /**
     * Test create brand works
     * @return void
     */
    public function test_create_brand_works()
    {
        $response = $this->json('POST', route('api.v1.brand.create'), [
            'title' => 'Test Brand',
        ], [
            'Authorization' => 'Bearer ' . $this->jwtToken
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJson([
            'data' => [
                'title' => 'Test Brand',
            ]
        ]);

        $this->assertDatabaseHas('brands', [
            'title' => 'Test Brand',
        ]);
    }

    /**
     * Test create brand fails if title is missing
     * @return void
     */
    public function test_create_brand_fails_if_title_is_missing()
    {
        $response = $this->json('POST', route('api.v1.brand.create'), [
            'title' => '',
        ], [
            'Authorization' => 'Bearer ' . $this->jwtToken
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test view brand works
     * @return void
     */
    public function test_view_brand_works()
    {
        $response = $this->json('GET', route('api.v1.brand.show', $this->brand->uuid));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson([
            'data' => [
                'id' => $this->brand->id,
                'uuid' => $this->brand->uuid,
                'title' => $this->brand->title,
            ]
        ]);
    }

    /**
     * Test list brand works
     * @return void
     */
    public function test_list_brand_works()
    {
        Brand::factory()->count(5)->create();

        $response = $this->json('GET', route('api.v1.brand.index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test update brand works
     * @return void
     */
    public function test_update_brand_works()
    {
        $response = $this->json('PATCH', route('api.v1.brand.update', $this->brand->uuid), [
            'title' => 'Test Brand Updated',
        ], [
            'Authorization' => 'Bearer ' . $this->jwtToken
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson([
            'data' => [
                'title' => 'Test Brand Updated',
            ]
        ]);

        $this->assertDatabaseHas('brands', [
            'title' => 'Test Brand Updated',
        ]);
    }

    /**
     * Test delete brand works
     * @return void
     */
    public function test_delete_brand_works()
    {
        $response = $this->json('DELETE', route('api.v1.brand.destroy', $this->brand->uuid), [], [
            'Authorization' => 'Bearer ' . $this->jwtToken
        ]);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('brands', [
            'id' => $this->brand->id,
        ]);
    }
}
