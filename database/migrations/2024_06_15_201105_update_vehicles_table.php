<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedBigInteger('mechanical_state_id')->nullable();
            $table->string('plate')->nullable();
            $table->foreign('model_id')->references('id')->on('vehicle_models')->onDelete('set null');
            $table->foreign('mechanical_state_id')->references('id')->on('mechanical_states')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['model_id']);
            $table->dropForeign(['mechanical_state_id']);
            $table->dropColumn(['model_id', 'mechanical_state_id', 'plate']);
        });
    }
}
