<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained()->onDelete('cascade');
            $table->string('seat_number');
            $table->enum('class', ['economy', 'business'])->default('economy');
            $table->boolean('is_emergency_exit')->default(false);
            $table->boolean('is_booked')->default(false);
            $table->decimal('price_multiplier', 3, 2)->default(1.00);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
