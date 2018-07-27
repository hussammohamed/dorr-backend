<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id')->nullable();
            $table->integer('m_property_id')->nullable();
            $table->integer('owner_user_id')->nullable();
            $table->integer('renter_user_id')->nullable();
            $table->integer('serial')->nullable();
            $table->date('issued_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('notification')->nullable();

            $table->integer('status')->default('0');
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
        Schema::dropIfExists('payments');
    }
}
