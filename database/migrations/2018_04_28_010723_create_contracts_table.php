<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');

            //$table->string('name');

            $table->integer('contract_type')->nullable();
            $table->integer('contract_condition')->nullable();
            $table->integer('contract_status')->nullable();
            $table->integer('contract_calender_type')->nullable();
            $table->integer('contract_place')->nullable();
            $table->date('contract_date')->nullable();
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->string('contract_image')->nullable();

            $table->integer('owner_user_id')->nullable();
            $table->string('owner_name')->nullable();
            $table->integer('owner_nationality')->nullable();
            $table->integer('owner_id_type')->nullable();
            $table->string('owner_id_no')->nullable();
            $table->string('owner_id_image')->nullable();
            $table->string('owner_mobile')->nullable();
            $table->string('owner_email')->nullable();
            
            $table->integer('renter_user_id');
            $table->string('renter_name')->nullable();
            $table->integer('renter_nationality')->nullable();
            $table->integer('renter_id_type')->nullable();
            $table->string('renter_id_no')->nullable();
            $table->string('renter_id_image')->nullable();
            $table->string('renter_mobile')->nullable();
            $table->string('renter_email')->nullable();
            

            

            $table->boolean('is_agent')->default('0');
            
            $table->integer('agency_id')->nullable();
            $table->string('agency_name')->nullable();
            $table->string('agency_address')->nullable();
            $table->string('agency_commercial_register_no')->nullable();
            $table->string('agency_phone')->nullable();
            $table->string('agency_fax')->nullable();
            
            $table->integer('agent_user_id')->nullable();
            $table->string('agent_name')->nullable();
            $table->integer('agent_nationality')->nullable();
            $table->integer('agent_id_type')->nullable();
            $table->string('agent_id_no')->nullable();
            $table->string('agent_id_image')->nullable();
            $table->string('agent_mobile')->nullable();
            $table->string('agent_email')->nullable();
            
            $table->integer('property_instrument_no')->nullable();
            $table->integer('property_instrument_issuer')->nullable();
            $table->date('property_instrument_date')->nullable();
            $table->integer('property_instrument_place')->nullable();
            
            $table->integer('m_property_id')->nullable();
            $table->string('m_property_address')->nullable();
            $table->integer('m_property_type')->nullable();
            $table->integer('m_property_floors')->nullable();
            $table->integer('m_property_units_no')->nullable();
            $table->integer('m_property_elevators')->nullable();
            $table->integer('m_property_parking')->nullable();
            $table->integer('usage_type')->nullable();
            
            $table->boolean('sublease')->default('0');
            
            $table->integer('agency_amount')->nullable();
            $table->integer('guarantee_amount')->nullable();
            $table->integer('electricity_monthly_amount')->nullable();
            $table->integer('water_monthly_amount')->nullable();
            $table->integer('gas_monthly_amount')->nullable();
            $table->integer('parking_monthly_amount')->nullable();
            $table->integer('rented_parking_no')->nullable();
            
            $table->integer('rent_monthly_amount')->nullable();
            $table->integer('rent_period')->nullable();
            $table->integer('rent_period_amount')->nullable();
            $table->integer('last_rent_amount')->nullable();
            $table->integer('rent_payments')->nullable();
            $table->integer('rent_total')->nullable();
            
            $table->string('terms')->nullable();

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
        Schema::dropIfExists('contracts');
    }
}
