<?php

namespace Tests\Feature\Admin\Auth;

use App\Actions\Auth\AuthAction;
use App\Models\User;
use App\Services\JWT\JwtBuilder;
use App\Services\JWT\JwtGuard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AdminAuthenticateTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $jwtToken;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->admin()->create();
        $this->jwtToken = (new AuthAction())->authenticate([
            'email' => $this->user->email,
            'password' => 'admin'
        ]);
    }

    /**
     * Test admin login validates.
     * @return void
     */
    public function test_admin_login_validates()
    {
        $response = $this->json('POST', route('api.v1.admin.auth.login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test admin login works
     * @return void
     */
    public function test_admin_login_works()
    {
        $response = $this->json('POST', route('api.v1.admin.auth.login'), [
            'email' => $this->user->email,
            'password' => 'admin',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test admin logout works
     * @return void
     */
    public function test_admin_logout_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)
            ->json('GET', route('api.v1.admin.auth.logout'), [
            'headers'
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
