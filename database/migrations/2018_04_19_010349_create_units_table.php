<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('m_property_id');
		    $table->string('name');
		    $table->integer('type');
		    $table->integer('floor');
		    $table->boolean('furnished');
		    $table->boolean('furnished_status')->default('0');
		    $table->boolean('kitchen_cabinet');
		    $table->integer('bed_rooms');
		    $table->integer('living_rooms');
		    $table->integer('reception_rooms');
		    $table->integer('bath_rooms');
		    $table->integer('split_air_conditioner');
		    $table->integer('window_air_conditioner');
		    $table->string('electricity_meter');
		    $table->string('water_meter');
		    $table->string('gas_meter');
			$table->integer('created_by');
		    $table->boolean('active')->default('1');
		    $table->boolean('deleted')->default('0');
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
        Schema::dropIfExists('units');
    }
}
