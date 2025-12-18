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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->foreignId('event_id')
              ->constrained('events')
              ->onDelete('cascade');

        $table->foreignId('ticket_id')
              ->constrained('tickets')
              ->onDelete('cascade');

        $table->integer('quantity');
        $table->integer('total_price');

        // STATUS PEMBAYARAN (opsional tapi penting)
        $table->enum('payment_status', ['pending', 'paid', 'failed'])
              ->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
