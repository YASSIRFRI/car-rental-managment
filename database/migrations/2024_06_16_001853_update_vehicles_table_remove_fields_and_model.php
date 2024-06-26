<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVehiclesTableRemoveFieldsAndModel extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('status');
            $table->dropColumn('model');
            $table->boolean('availability')->default(1)->change();
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('type');
            $table->string('status');
            $table->string('model');
            $table->boolean('availability')->default(1)->change();
        });
    }
}
