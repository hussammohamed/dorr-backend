<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('m_property_id')->nullable();
            $table->integer('unit_id')->nullable();
            
            $table->string('service_type')->nullable();
            $table->string('service')->nullable();
            $table->string('description')->nullable();

            $table->integer('owner_response')->nullable();
            $table->integer('min_fix_amount')->nullable();

            $table->integer('laborer_pay')->nullable();
            $table->integer('matrials_price')->nullable();
            $table->string('invoice_image')->nullable();

            $table->integer('status')->default('1');
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
        Schema::dropIfExists('maintenances');
    }
}
