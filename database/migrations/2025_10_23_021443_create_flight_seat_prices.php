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
        Schema::create('flight_seat_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained()->onDelete('cascade');
            $table->string('seat_class'); // economy, business
            $table->decimal('price', 10, 2);
            $table->integer('available_seats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_seat_prices');
    }
};
