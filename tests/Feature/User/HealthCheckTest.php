<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    /**
     * Test health check is working for user api.
     * @return void
     */
    public function test_user_route_health_check_is_working()
    {
        $response = $this->get(route('api.v1.health-check'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
