<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_destinations_table.php

    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('lokasi');
            $table->text('deskripsi')->nullable();
            $table->foreignId('kategori_id')->constrained('categories')->onDelete('cascade');
            $table->json('fasilitas')->nullable();
            $table->float('rating_rata2')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
