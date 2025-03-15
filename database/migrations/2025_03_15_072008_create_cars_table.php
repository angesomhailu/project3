<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->string('color');
            $table->string('license_plate')->unique();
            $table->decimal('daily_rate', 10, 2);
            $table->text('description');
            $table->decimal('mileage', 10, 1);
            $table->string('transmission');
            $table->string('fuel_type');
            $table->integer('seats');
            $table->json('images')->nullable();
            $table->json('features')->nullable();
            $table->enum('status', ['available', 'maintenance', 'rented'])->default('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};