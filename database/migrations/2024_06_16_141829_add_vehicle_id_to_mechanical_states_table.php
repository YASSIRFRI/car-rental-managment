<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVehicleIdToMechanicalStatesTable extends Migration
{
    public function up()
    {
        Schema::table('mechanical_states', function (Blueprint $table) {
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('mechanical_states', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropColumn('vehicle_id');
        });
    }
}
