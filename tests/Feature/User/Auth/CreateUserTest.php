<?php

namespace Tests\Feature\User\Auth;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * Test user create validation works.
     */
    public function test_user_create_validation_works()
    {
        $response = $this->json('POST', route('api.v1.user.create'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => '',
            'password' => 'admin',
            'password_confirmation' => 'admin',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'email',
            'password',
            'avatar',
            'phone_number',
            'address',
        ]);
    }


    /*
    * Test user create works.
*/
    public function test_user_create_works()
    {
        $response = $this->json('POST', route('api.v1.user.create'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@example.com',
            'password' => 'P@ssw0rd',
            'password_confirmation' => 'P@ssw0rd',
            'avatar' => File::factory()->create()->uuid,
            'phone_number' => '01234567890',
            'address' => '123 Fake Street',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }
}
