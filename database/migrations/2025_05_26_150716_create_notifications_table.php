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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary(); // CHAR(36) PRIMARY KEY
            $table->string('type'); // VARCHAR(255) NOT NULL
            $table->string('notifiable_type'); // VARCHAR(255) NOT NULL
            $table->unsignedBigInteger('notifiable_id'); // BIGINT UNSIGNED NOT NULL
            $table->text('data'); // TEXT NOT NULL
            $table->timestamp('read_at')->nullable(); // TIMESTAMP NULL
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
