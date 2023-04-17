<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class JWTGenerateKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jwt:generate {--show : Display the key instead of modifying files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a JWT public and private key pair';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $secret = sodium_crypto_sign_keypair();

        $publicKey = base64_encode(sodium_crypto_sign_publickey($secret));

        $privateKey = base64_encode(sodium_crypto_sign_secretkey($secret));

        if ($this->option('show')) {
            $this->line('<comment>JWT_PUBLIC_KEY:</comment> ' . $publicKey);
            $this->line('<comment>JWT_PRIVATE_KEY:</comment> ' . $privateKey);
            return;
        }

        $envPath = base_path('.env');

        if (!file_exists($envPath)) {
            $this->error('The .env file does not exist. Please create one first.');
            return;
        }

        // Update the .env file with the new keys, if they don't already exist append them to the end of the file
        $envContents = file_get_contents($envPath);
        $envContents = preg_replace('/JWT_PUBLIC_KEY=.*/', 'JWT_PUBLIC_KEY=' . $publicKey, $envContents);
        $envContents = preg_replace('/JWT_PRIVATE_KEY=.*/', 'JWT_PRIVATE_KEY=' . $privateKey, $envContents);

        if (!strpos($envContents, 'JWT_PUBLIC_KEY=')) {
            $envContents .= PHP_EOL . 'JWT_PUBLIC_KEY=' . $publicKey;
        }

        if (!strpos($envContents, 'JWT_PRIVATE_KEY=')) {
            $envContents .= PHP_EOL . 'JWT_PRIVATE_KEY=' . $privateKey;
        }

        file_put_contents($envPath, $envContents);

        $this->info('JWT public and private key pair generated successfully.');
    }
}
