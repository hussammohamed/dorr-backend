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

            $table->integer('contract_type_id');
            $table->integer('contract_condition');
            $table->integer('contract_status');
            $table->integer('contract_calender_type');
            $table->integer('contract_place');
            $table->date('contract_date');
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            
            $table->integer('owner_id');
            $table->string('owner_name');
            $table->integer('owner_nationality');
            $table->integer('owner_id_type');
            $table->integer('owner_id_no');
            $table->string('owner_id_image');
            $table->integer('owner_mobile');
            $table->integer('owner_email');
            
            $table->integer('renter_id');
            $table->string('renter_name');
            $table->integer('renter_nationality');
            $table->integer('renter_id_type');
            $table->integer('renter_id_no');
            $table->string('renter_id_image');
            $table->string('renter_mobile');
            $table->string('renter_email');
            
            $table->boolean('is_agent')->default('0');
            
            $table->integer('agency_id')->nullable();;
            $table->string('agency_name')->nullable();;
            $table->string('agency_address')->nullable();;
            $table->string('agency_comerial_no')->nullable();;
            $table->string('agency_phone')->nullable();;
            $table->string('agency_fax')->nullable();;
            
            $table->integer('agent_id')->nullable();;
            $table->string('agent_name')->nullable();;
            $table->integer('agent_nationality')->nullable();;
            $table->integer('agent_id_type')->nullable();;
            $table->integer('agent_id_no')->nullable();;
            $table->string('agent_id_image')->nullable();;
            $table->string('agent_mobile')->nullable();;
            $table->string('agent_email')->nullable();;
            
            $table->integer('property_instrument_no');
            $table->integer('property_instrument_issuer');
            $table->date('property_instrument_date');
            $table->integer('property_instrument_place');
            
            $table->integer('m_property_id');
            $table->string('m_property_address');
            $table->integer('m_property_type');
            $table->integer('m_property_usage_type');
            $table->integer('m_property_floors');
            $table->integer('m_property_units_no');
            $table->integer('m_property_elevators');
            $table->integer('m_property_parking');
            
            $table->integer('unit_id');
            $table->integer('unit_type');
            $table->integer('unit_no');
            $table->integer('unit_furnished');
            $table->integer('unit_furnished_status');
            $table->integer('unit_floor');
            $table->integer('unit_kitchen_cabinet');
            $table->integer('unit_bed_rooms');
            $table->integer('unit_living_rooms');
            $table->integer('unit_reception_rooms');
            $table->integer('unit_bath_rooms');
            $table->integer('unit_split_air_conditioner');
            $table->integer('unit_window_air_conditioner');
            $table->integer('unit_electricity_meter');
            $table->integer('unit_electricity_measurement');
            $table->integer('unit_water_meter');
            $table->integer('unit_water_measurement');
            $table->integer('unit_gas_meter');
            $table->integer('unit_gas_measurement');
            
            $table->boolean('sublease')->default('0');
            
            $table->integer('agency_amount');
            $table->integer('guarantee_amount');
            $table->integer('electricity_monthly_amount');
            $table->integer('water_monthly_amount');
            $table->integer('gas_monthly_amount');
            $table->integer('parking_monthly_amount');
            $table->integer('rented_parking_no');
            
            $table->integer('rent_monthly_amount');
            $table->integer('rent_period');
            $table->integer('rent_period_amount');
            $table->integer('last_rent_amount');
            $table->integer('rent_payments');
            $table->integer('rent_total');
            
            $table->integer('created_by');
            
            $table->integer('rent_payment_no');
            $table->integer('rent_payment_issued_date');
            $table->integer('rent_payment_due_date');
            $table->integer('rent_payment_amount');

            $table->string('terms');

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
