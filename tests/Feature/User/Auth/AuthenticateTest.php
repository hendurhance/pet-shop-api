<?php

namespace Tests\Feature\User\Auth;

use App\Actions\Auth\AuthAction;
use App\Actions\Auth\CreateResetTokenAction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $jwtToken;
    
    private $resetToken;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->user()->create();
        $this->jwtToken = (new AuthAction())->authenticate([
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->resetToken = (new CreateResetTokenAction())->execute($this->user);
    }

    /**
     * Test user login validates invalid credentials.
     * @return void
     */
    public function test_user_login_validates_invalid_credentials()
    {
        $response = $this->json('POST', route('api.v1.user.login'), [
            'email' => $this->user->email,
            'password' => 'test',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test user login works.
     * @return void
     */
    public function test_user_login_works()
    {
        $response = $this->json('POST', route('api.v1.user.login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test user logout works.
     * @return void
     */
    public function test_user_logout_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)
            ->json('GET', route('api.v1.user.logout'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test user forgot password
     */
    public function test_user_forgot_password_works()
    {
        $response = $this->json('POST', route('api.v1.user.forgot-password'), [
            'email' => $this->user->email,
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test user reset password works
     */
    public function test_user_reset_password_works()
    {
        $response = $this->json('POST', route('api.v1.user.reset-password-token'), [
            'token' => $this->resetToken,
            'email' => $this->user->email,
            'password' => 'N3wp@ssword',
            'password_confirmation' => 'N3wp@ssword',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
