<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('event_id');
        $table->string('type'); // Early Bird, Regular, VIP
        $table->integer('price');
        $table->integer('stock'); // sisa tiket
        $table->timestamps();

        $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
