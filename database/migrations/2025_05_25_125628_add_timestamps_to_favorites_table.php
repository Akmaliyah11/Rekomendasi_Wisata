<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('favorites', function (Blueprint $table) {
            // Cek dulu, tambahkan hanya jika belum ada
            if (!Schema::hasColumn('favorites', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropColumn('updated_at');
        });
    }
};
