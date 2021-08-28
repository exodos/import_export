<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransmissionAmplifierBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transmission_amplifier_boards', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('board_name');
            $table->bigInteger('slot_number');
            $table->string('type');
            $table->string('gain');
            $table->string('direction');
            $table->foreignId('transmission_equipment_id')->constrained('transmission_equipment')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('transmission_site_id')->constrained('transmission_sites')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('transmission_amplifier_boards');
    }
}
