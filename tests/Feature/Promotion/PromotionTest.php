<?php

namespace Tests\Feature\Promotion;

use App\Actions\Auth\AuthAction;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PromotionTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $promotions;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->user()->create();
        $this->promotions = Promotion::factory()->count(5)->create();
    }

    /**
     * Test list all promotions works.
     * @return void
     */
    public function test_list_all_promotions_works()
    {
        $response = $this->json('GET', route('api.v1.main.promotion.index'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'uuid' => $this->promotions[0]->uuid,
            'title' => $this->promotions[0]->title,
        ]);
    }
}
