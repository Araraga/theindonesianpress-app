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
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // FK to users
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // FK to categories

            $table->string('title'); // VARCHAR(255) NOT NULL
            $table->string('slug')->unique(); // VARCHAR(255) NOT NULL UNIQUE
            $table->longText('content'); // LONGTEXT NOT NULL
            $table->string('featured_image')->nullable(); // featured_image VARCHAR(255) NULL
            $table->text('excerpt')->nullable(); // excerpt TEXT NULL

            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // ENUM
            $table->unsignedInteger('view_count')->default(0); // INT UNSIGNED DEFAULT 0
            $table->timestamp('published_at')->nullable(); // TIMESTAMP NULL

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
