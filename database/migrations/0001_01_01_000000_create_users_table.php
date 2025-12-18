<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // tambahan field
            $table->string('nama_lengkap');
            $table->string('nomor_telepon')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('kota');

            $table->string('email')->unique();
            $table->boolean('is_verified')->default(false);

            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
