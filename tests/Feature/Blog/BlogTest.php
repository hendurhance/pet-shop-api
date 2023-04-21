<?php

namespace Tests\Feature\Blog;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $blogs;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->user()->create();
        $this->blogs = Post::factory()->count(5)->create();
    }

    /**
     * Test list all blogs works.
     * @return void
     */
    public function test_list_all_blogs_works()
    {
        $response = $this->json('GET', route('api.v1.main.blog.index'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'uuid' => $this->blogs[0]->uuid,
            'title' => $this->blogs[0]->title,
        ]);
    }

    /**
     * Test show blog works.
     * @return void
     */
    public function test_show_blog_works()
    {
        $response = $this->json('GET', route('api.v1.main.blog.show', $this->blogs[0]->uuid));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'uuid' => $this->blogs[0]->uuid,
            'title' => $this->blogs[0]->title,
        ]);
    }
}
