<?php

namespace Tests\Feature\Admin;

use App\Actions\Auth\AuthAction;
use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    private $jwtToken;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->jwtToken = (new AuthAction())->authenticate([
            'email' => $this->admin->email,
            'password' => 'admin'
        ]);
    }
    
    /**
     * Test admin can get user listing
     */
    public function test_admin_can_get_user_listing()
    {
        User::factory()->count(10)->user()->create();
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)
            ->json('GET', route('api.v1.admin.user.listing'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test admin can get edit user details
     */
    public function test_admin_can_get_edit_user_details()
    {
        $user = User::factory()->user()->create();
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)
            ->json('PUT', route('api.v1.admin.user.edit', $user->uuid), [
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'admin1@buckhill.co.uk',
                'password' => 'P@ssw0rd',
                'password_confirmation' => 'P@ssw0rd',
                'avatar' => File::factory()->create()->uuid,
                'phone_number' => '01234567890',
                'address' => '123 Fake Street',
            ]);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('users', [
            'uuid' => $user->uuid,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
        ]);
    }

    /**
     * Test admin can get delete user
     */
    public function test_admin_can_get_delete_user()
    {
        $user = User::factory()->user()->create();
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)
            ->json('DELETE', route('api.v1.admin.user.delete', $user->uuid));

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseMissing('users', [
            'uuid' => $user->uuid,
        ]);
    }
}
