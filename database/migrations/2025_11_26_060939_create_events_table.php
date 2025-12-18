<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->unsignedBigInteger('category_id');
            $table->string('location');
            $table->string('city');
            $table->date('event_date');
            $table->time('event_time');
            $table->string('image')->nullable();
            $table->integer('starting_price');
            $table->timestamps();

            // Foreign key harus setelah tabel categories ada
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
