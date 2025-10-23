<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained()->onDelete('cascade');
            $table->string('model');
            $table->string('registration_number')->unique();
            $table->integer('seat_capacity');
            $table->integer('business_class_seats')->default(0);
            $table->integer('economy_class_seats')->default(0); //
            $table->integer('max_speed')->nullable();
            $table->integer('range')->nullable();
            $table->year('manufacture_year')->nullable();
            $table->enum('status', ['active', 'maintenance', 'inactive'])->default('active');
            $table->text('features')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planes');
    }
};