<?php
// Migration: Hapus kolom genre dan hanya atur subheadline di tabel articles
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'genre')) {
                $table->dropColumn('genre');
            }
            if (!Schema::hasColumn('articles', 'subheadline')) {
                $table->string('subheadline')->nullable()->after('title');
            } else {
                $table->string('subheadline')->nullable()->change();
            }
        });
    }
    public function down(): void {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'subheadline')) {
                $table->dropColumn('subheadline');
            }
        });
    }
};
