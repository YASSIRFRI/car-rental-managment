<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMechanicalStatesTable extends Migration
{
    public function up()
    {
        Schema::create('mechanical_states', function (Blueprint $table) {
            $table->id();
            $table->date('last_oil_change')->nullable();
            $table->integer('mileage')->nullable();
            $table->string('tire_condition')->nullable();
            $table->string('brake_condition')->nullable();
            $table->string('engine_condition')->nullable();
            $table->date('technical_inspection')->nullable();
            $table->string('technical_inspection_comment')->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mechanical_states');
    }
}

