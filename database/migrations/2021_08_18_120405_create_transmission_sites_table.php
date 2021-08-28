<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransmissionSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transmission_sites', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('site_name');
            $table->double('latitude',10,8);
            $table->double('longitude', 11,8);
            $table->string('city');
            $table->string('region');
            $table->string('et_region_zone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transmission_sites');
    }
}
