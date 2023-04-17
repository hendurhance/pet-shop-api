<?php

namespace Tests\Feature\Admin\Auth;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateAdminTest extends TestCase
{
    /**
     * Test admin create validation works.
     */
    public function test_admin_create_validation_works()
    {
        $response = $this->json('POST', route('api.v1.admin.auth.create'), [
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
            'phone',
            'address',
        ]);
    }


    /*
    * Test admin create works.
    */
    public function test_admin_create_works()
    {
        $response = $this->json('POST', route('api.v1.admin.auth.create'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'admin@buckhill.co.uk',
            'password' => 'P@ssw0rd',
            'password_confirmation' => 'P@ssw0rd',
            'avatar' => File::factory()->create()->uuid,
            'phone' => '01234567890',
            'address' => '123 Fake Street',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

    }
}
