<?php

namespace Tests\Feature\File;

use App\Actions\Auth\AuthAction;
use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class FileTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $jwtToken;

    private $file;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->user()->create();
        $this->jwtToken = (new AuthAction())->authenticate([
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->file = File::factory()->create();
    }


    /**
     * Test view file works
     * @return void
     */
    public function test_view_file_works()
    {
        $response = $this->json('GET', route('api.v1.file.show', $this->file->uuid));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson([
            'data' => [
                'id' => $this->file->id,
                'uuid' => $this->file->uuid,
                'name' => $this->file->name,
                'path' => $this->file->path,
            ]
        ]);
    }

    /**
     * Test file uploads works
     * @return void
     */
    public function test_file_uploads_works()
    {
        $fakeImage = UploadedFile::fake()->image('avatar.jpg');
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)
            ->json('POST', route('api.v1.file.upload'), [
                'file' => $fakeImage
            ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJson([
            'data' => [
                'name' => $fakeImage->getClientOriginalName(),
                'type' => $fakeImage->getMimeType(),
            ]
        ]);
    }

    /**
     * Test file upload fails with invalid file
     * @return void
     */
    public function test_file_upload_fails_with_invalid_file()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)
            ->json('POST', route('api.v1.file.upload'), [
                'file' => 'test'
            ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
