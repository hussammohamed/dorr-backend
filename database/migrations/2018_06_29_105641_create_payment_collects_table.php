<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentCollectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_collects', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('payment_order_id')->nullable();

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
        Schema::dropIfExists('payment_collects');
    }
}
