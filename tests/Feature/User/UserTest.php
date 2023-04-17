<?php

namespace Tests\Feature\User;

use App\Actions\Auth\AuthAction;
use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PDO;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
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
    }

    /**
     * Test view user works
     * @return void
     */
    public function test_view_user_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)
            ->json('GET', route('api.v1.user.show', $this->user->id));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson([
            'data' => [
                'id' => $this->user->id,
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
            ]
        ]);
    }

    /**
     * Test view edit user works
     * @return void
     */
    public function test_view_edit_user_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)
            ->json('PUT', route('api.v1.user.edit', $this->user->id), [
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'test2@example.com',
                'password' => 'P@ssw0rd',
                'password_confirmation' => 'P@ssw0rd',
                'avatar' => File::factory()->create()->uuid,
                'phone_number' => '01234567890',
                'address' => '123 Fake Street',
            ]);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'first_name' => 'Jane',
            'last_name' => 'Doe'
        ]);
    }

    /**
     * Test delete user works
     * @return void
     */
    public function test_delete_user_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)
            ->json('DELETE', route('api.v1.user.destroy', $this->user->id));

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id,
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
        ]);
    }
}
