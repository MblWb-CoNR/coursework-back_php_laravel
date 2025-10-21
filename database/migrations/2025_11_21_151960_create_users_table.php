<?php

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();

            $table->foreignId('avatar_id')->nullable()->constrained('avatars')->onDelete('set null');
            $table->foreignId('messenger_id')->nullable()->constrained('messengers')->onDelete('set null');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->foreignId('signup_id')->constrained('signups')->onDelete('cascade');
            $table->foreignId('feedback_id')->constrained('feedbacks')->onDelete('cascade');
            $table->foreignId('sketch_id')->constrained('sketches')->onDelete('cascade');


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
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
