<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('event_title');
            $table->string('ticket_type');
            $table->integer('quantity');
            $table->integer('total_price');

            $table->string('payment_method'); // qris / va / ewallet
            $table->string('payment_channel')->nullable(); // bca / bri / mandiri / gopay dll

            $table->string('status')->default('success'); // simple
            $table->string('ticket_pdf')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
