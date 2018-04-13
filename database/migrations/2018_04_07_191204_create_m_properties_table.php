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
		    $table->string('owner_name');
		    $table->integer('owner_nationality');
		    $table->string('owner_address');
		    $table->integer('owner_id_type');
		    $table->string('owner_id_no');
		    $table->integer('owner_id_issuer');
		    $table->date('owner_id_date');
            $table->date('owner_id_exp_date');
            $table->string('owner_email');
            $table->string('owner_mobile');
            $table->integer('owner_bank')->nullable();
            $table->string('owner_bank_iban')->nullable();
		    $table->boolean('owner_is_agent')->default('0');

		    $table->integer('agent_user_id')->nullable();
		    $table->string('agent_name')->nullable();
		    $table->integer('agent_nationality')->nullable();
		    $table->string('agent_address')->nullable();
		    $table->integer('agent_id_type')->nullable();
		    $table->string('agent_id_no')->nullable();
		    $table->integer('agent_id_issuer')->nullable();
		    $table->date('agent_id_date')->nullable();
            $table->date('agent_id_exp_date')->nullable();
		    $table->string('agent_email')->nullable();
            $table->string('agent_mobile')->nullable();
		    $table->string('agent_instrument_no')->nullable();
		    $table->integer('agent_instrument_issuer')->nullable();
		    $table->date('agent_instrument_date')->nullable();
            $table->date('agent_instrument_exp_date')->nullable();
		    $table->integer('agent_bank')->nullable();
		    $table->string('agent_bank_iban')->nullable();
            $table->string('commercial_register_name')->nullable();
            $table->string('commercial_register_no')->nullable();
		    $table->integer('commercial_register_issuer')->nullable();
		    $table->date('commercial_register_date')->nullable();
            $table->date('commercial_register_exp_date')->nullable();

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
