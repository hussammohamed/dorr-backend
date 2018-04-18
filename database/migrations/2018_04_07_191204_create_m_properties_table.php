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
		    $table->integer('units');
		    $table->integer('elevators');
		    $table->integer('parking');
		    $table->integer('year_of_construction');
		    $table->string('property_instrument_no')->nullable();
		    $table->integer('property_instrument_issuer')->nullable();
		    $table->date('property_instrument_date')->nullable();
            $table->string('property_instrument_place')->nullable();
            
			$table->integer('owner_user_id');
			
		    $table->boolean('owner_is_agent')->default('1');

		    $table->integer('agent_user_id')->nullable();
			
			
		    $table->string('agent_instrument_no')->nullable();
		    $table->integer('agent_instrument_issuer')->nullable();
		    $table->date('agent_instrument_date')->nullable();
			$table->date('agent_instrument_exp_date')->nullable();

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
        Schema::dropIfExists('m_properties');
    }
}
