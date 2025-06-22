<?php
// Migration: Membuat kolom category_id pada tabel articles menjadi nullable
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->change();
        });
    }
    public function down(): void {
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable(false)->change();
        });
    }
};
