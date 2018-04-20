<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_properties', function (Blueprint $table) {
            $table->increments('id');
		    $table->string('name');
		    $table->integer('type');
		    $table->string('address');
		    $table->integer('district');
		    $table->decimal('lat', 20, 18);
            $table->decimal('long', 20, 18);
		    $table->integer('floors');
		    $table->integer('units_no');
		    $table->integer('elevators');
		    $table->integer('parking');
		    $table->integer('year_of_construction');
		    $table->string('property_instrument_no')->nullable();
		    $table->integer('property_instrument_issuer')->nullable();
		    $table->date('property_instrument_date')->nullable();
            $table->string('property_instrument_place')->nullable();
            $table->string('property_instrument_image')->nullable();
			$table->integer('owner_user_id')->nullable();
		    $table->integer('agent_user_id')->nullable();
		    $table->string('agency_instrument_no')->nullable();
		    $table->integer('agency_instrument_issuer')->nullable();
		    $table->date('agency_instrument_date')->nullable();
			$table->date('agency_instrument_exp_date')->nullable();
            $table->string('agency_instrument_image')->nullable();
            $table->string('property_management_contract_image')->nullable();
			$table->integer('user_relation');
			$table->integer('created_by');
		    $table->boolean('active')->default('1');
		    $table->boolean('deleted')->default('0');
            $table->timestamps();
        });
        \DB::statement("UPDATE m_properties SET owner_user_id = id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_properties');
    }
}
