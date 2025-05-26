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
        Schema::create('followers', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade'); // FK ke users
            $table->foreignId('following_id')->constrained('users')->onDelete('cascade'); // FK ke users

            $table->timestamps(); // created_at, updated_at

            $table->unique(['follower_id', 'following_id']); // UNIQUE(follower_id, following_id)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
