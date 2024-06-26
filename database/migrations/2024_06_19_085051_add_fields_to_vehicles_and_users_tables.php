<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToVehiclesAndUsersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->after('availability');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('city')->nullable()->after('role');
            $table->string('zip_code')->nullable()->after('city');
            $table->string('address')->nullable()->after('zip_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('price');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['city', 'zip_code', 'address']);
        });
    }
}
