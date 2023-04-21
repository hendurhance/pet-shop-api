<?php

namespace Tests\Feature\Category;

use App\Actions\Auth\AuthAction;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $jwtToken;

    private $categories;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->user()->create();
        $this->jwtToken = (new AuthAction())->authenticate([
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->categories = Category::factory()->count(5)->create();
    }

    /**
     * Test create category works
     * @return void
     */
    public function test_create_category_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.category.create'), [
            'title' => 'Test Category',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJson([
            'data' => [
                'title' => 'Test Category',
            ]
        ]);

        $this->assertDatabaseHas('categories', [
            'title' => 'Test Category',
        ]);
    }

    /**
     * Test create category fails when title is missing
     * @return void
     */
    public function test_create_category_fails_when_title_is_missing()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.category.create'), [
            'title' => '',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJson([
            'errors' => [
                'title' => [
                    0 => 'The title field is required.'
                ]
            ]
        ]);
    }

    /**
     * Test list categories works
     * @return void
     */
    public function test_list_categories_works()
    {
        $response = $this->json('GET', route('api.v1.category.index'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'uuid' => $this->categories[0]->uuid,
            'title' => $this->categories[0]->title,
        ]);
    }

    /**
     * Test show category works
     * @return void
     */
    public function test_show_category_works()
    {
        $response = $this->json('GET', route('api.v1.category.show', $this->categories[0]->uuid));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'uuid' => $this->categories[0]->uuid,
            'title' => $this->categories[0]->title,
        ]);
    }

    /**
     * Test update category works
     * @return void
     */
    public function test_update_category_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('PUT', route('api.v1.category.update', $this->categories[0]->uuid), [
            'title' => 'Test Category Updated',
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'uuid' => $this->categories[0]->uuid,
            'title' => 'Test Category Updated',
        ]);

        $this->assertDatabaseHas('categories', [
            'uuid' => $this->categories[0]->uuid,
            'title' => 'Test Category Updated',
        ]);
    }

    /**
     * Test delete category works
     * @return void
     */
    public function test_delete_category_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('DELETE', route('api.v1.category.destroy', $this->categories[0]->uuid));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('categories', [
            'uuid' => $this->categories[0]->uuid,
        ]);
    }
}
