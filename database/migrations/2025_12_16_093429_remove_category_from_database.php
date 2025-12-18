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
        // 1. Hapus kolom category_id di tabel events
        Schema::table('events', function (Blueprint $table) {
            // Kita drop foreign key dulu (jika ada relasinya)
            // Nama constraint biasanya: events_category_id_foreign
            // Kalau nanti error "constraint not found", baris dropForeign ini bisa dihapus/dikomentari.
            $table->dropForeign(['category_id']); 
            
            // Hapus kolomnya
            $table->dropColumn('category_id');
        });

        // 2. Hapus tabel categories
        Schema::dropIfExists('categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Buat ulang tabel categories (untuk rollback)
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Tambah ulang kolom category_id di events
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories');
        });
    }
};