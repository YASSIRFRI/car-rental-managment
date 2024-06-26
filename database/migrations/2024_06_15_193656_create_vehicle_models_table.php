<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleModelsTable extends Migration
{
    public function up()
    {
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('constructor');
            $table->string('image')->nullable();
            $table->integer('number_of_seats')->nullable();
            $table->integer('horsepower')->nullable();
            $table->integer('top_speed')->nullable();
            $table->integer('price')->nullable();
            $table->integer('year')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('transmission')->nullable();
            $table->string('drive_train')->nullable();
            $table->string('fuel_consumption')->nullable();
            $table->string('trunk_size')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_models');
    }
}

