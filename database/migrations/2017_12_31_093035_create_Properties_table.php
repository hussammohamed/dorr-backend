<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('user_id');
		    $table->integer('type');
		    $table->integer('purpose');
            $table->string('title');
		    $table->string('ownerName');
		    $table->string('address');
		    $table->integer('region');
		    $table->decimal('lat', 9, 6);
		    $table->decimal('long', 9, 6);
		    $table->text('description')->nullable();
		    $table->integer('price')->default('0');
		    $table->integer('pricePerMeter')->default('0');
		    $table->date('dateOfConstruction');
		    $table->integer('area')->default('0');
		    $table->integer('floor')->default('0');
		    $table->integer('finishType');
		    $table->integer('overlooks');
		    $table->integer('paymentMethods');
		    $table->integer('rooms')->default('0');
		    $table->integer('bathrooms')->default('0');
		    $table->integer('adID')->default('0');
		    $table->integer('hits')->default('0');
		    $table->string('youtube')->nullable();
		    $table->integer('advertiserType')->default('0');
		    $table->date('dateOfPublication');
		    $table->date('startDate')->nullable();
		    $table->date('endDate')->nullable();
		    $table->integer('lang')->default('1');
		    $table->boolean('featured')->default('0');
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
        Schema::dropIfExists('properties');
    }
}
