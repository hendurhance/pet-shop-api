<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
            $this->showKeys($publicKey, $privateKey);
        } else {
            $this->updateEnvFile($publicKey, $privateKey);
        }
    }

    protected function showKeys($publicKey, $privateKey)
    {
        $this->line('<comment>JWT_PUBLIC_KEY:</comment> ' . $publicKey);
        $this->line('<comment>JWT_PRIVATE_KEY:</comment> ' . $privateKey);
    }

    protected function updateEnvFile($publicKey, $privateKey)
    {
        $envPath = base_path('.env');

        if (!file_exists($envPath)) {
            $this->error('The .env file does not exist. Please create one first.');
            return;
        }

        $envContents = file_get_contents($envPath);
        $envContents = $this->replaceOrAppendKey($envContents, 'JWT_PUBLIC_KEY', $publicKey);
        $envContents = $this->replaceOrAppendKey($envContents, 'JWT_PRIVATE_KEY', $privateKey);

        file_put_contents($envPath, $envContents);

        $this->info('JWT public and private key pair generated successfully.');
    }

    protected function replaceOrAppendKey($envContents, $keyName, $keyValue)
    {
        $pattern = "/$keyName=.*/";
        $replacement = "$keyName=$keyValue";

        if (preg_match($pattern, $envContents)) {
            return preg_replace($pattern, $replacement, $envContents);
        } else {
            return $envContents . PHP_EOL . $replacement;
        }
    }
}
