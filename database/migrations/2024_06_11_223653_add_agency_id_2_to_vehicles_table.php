<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddAgencyId2ToVehiclesTable extends Migration
{
    public function up()
    {
        $defaultAgencyId = DB::table('users')->first()->id ?? null;
        if ($defaultAgencyId === null) {
            $defaultAgencyId = DB::table('users')->insertGetId([
                'name' => 'Default Agency',
                'email' => 'default@agency.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('vehicles', function (Blueprint $table) use ($defaultAgencyId) {
            $table->foreignId('agency_id')->default($defaultAgencyId)->constrained('users')->onDelete('cascade');
        });

        // Update existing records to set the default agency id
        DB::table('vehicles')->update(['agency_id' => $defaultAgencyId]);

    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['agency_id']);
            $table->dropColumn('agency_id');
        });
    }
}
