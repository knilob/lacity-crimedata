<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crimes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('dr_no');
            $table->string('date_rptd');
            $table->string('date_occ');
            $table->string('time_occ');
            $table->string('area');
            $table->string('area_name');
            $table->string('rpt_dist_no');
            $table->string('part_1_2');
            $table->string('crime_cd');
            $table->string('crime_cd_desc');
            $table->string('mocodes');
            $table->string('vict_age');
            $table->string('vict_sex');
            $table->string('vict_descent');
            $table->string('premis_cd');
            $table->string('premis_desc');
            $table->string('weapon_used_cd')->nullable();
            $table->string('weapon_desc')->nullable();
            $table->string('status');
            $table->string('status_desc');
            $table->string('crime_cd_1')->nullable();
            $table->string('crime_cd_2')->nullable();
            $table->string('crime_cd_3')->nullable();
            $table->string('crime_cd_4')->nullable();
            $table->string('location');
            $table->string('cross_street');
            $table->decimal('lat', 10, 8);
            $table->decimal('long', 11, 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crimes');
    }
}
