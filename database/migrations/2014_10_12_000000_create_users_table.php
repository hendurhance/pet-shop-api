<?php

use App\Enums\HasMarketingEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('is_admin')->default(UserTypeEnum::IS_USER);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->uuid('avatar')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('is_marketing')->default(HasMarketingEnum::HAS_NO_MARKETING);
            $table->dateTime('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
