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
		    $table->integer('advertiser_type');
		    $table->integer('type');
		    $table->integer('purpose');
            $table->string('title');
		    $table->string('address');
		    $table->integer('region');
		    $table->decimal('lat', 9, 6);
		    $table->decimal('long', 9, 6);
		    $table->text('description')->nullable();
		    $table->integer('price')->default('0');
		    $table->integer('year_of_construction');
		    $table->integer('area')->default('0');
		    $table->integer('floor')->default('0');
		    $table->integer('finish_type');
		    $table->integer('overlooks');
		    $table->integer('payment_methods');
		    $table->integer('rooms')->default('0');
		    $table->integer('bathrooms')->default('0');
		    $table->integer('ad_id')->unique();
		    $table->integer('hits')->default('0');
		    $table->string('youtube')->nullable();
		    $table->date('startDate')->nullable();
		    $table->date('endDate')->nullable();
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
