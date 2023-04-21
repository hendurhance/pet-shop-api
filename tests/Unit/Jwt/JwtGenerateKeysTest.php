<?php

namespace Tests\Unit\Jwt;

use App\Console\Commands\JWTGenerateKeys;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class JwtGenerateKeysTest extends TestCase
{
    /**
     * Test the handle method of the JWTGenerateKeys command.
     *
     * @return void
     */
    public function test_keys_generate()
    {
        // Run the command without the --show option
        $this->artisan('jwt:generate')
            ->expectsOutput('JWT public and private key pair generated successfully.')
            ->assertExitCode(0);

        // Verify that the .env file was updated with the keys
        $this->assertStringContainsString('JWT_PUBLIC_KEY=', file_get_contents(base_path('.env.testing')));
        $this->assertStringContainsString('JWT_PRIVATE_KEY=', file_get_contents(base_path('.env.testing')));
    }
}
