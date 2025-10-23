<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plane_id')->constrained()->onDelete('cascade');
            $table->foreignId('origin_airport_id')->constrained('airports');
            $table->foreignId('destination_airport_id')->constrained('airports');
            $table->string('flight_number')->unique();
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->integer('duration_minutes');
            $table->decimal('price_per_seat', 10, 2); // ✅ GUNAKAN price_per_seat
            $table->integer('available_seats');
            $table->enum('status', ['scheduled', 'active', 'cancelled', 'completed'])->default('scheduled'); // ✅ TAMBAH status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};