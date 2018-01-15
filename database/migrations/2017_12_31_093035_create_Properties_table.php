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
		    $table->decimal('lat', 20, 18);
		    $table->decimal('long', 20, 18);
		    $table->text('description')->nullable();
		    $table->integer('price');
		    $table->integer('year_of_construction', 4);
		    $table->integer('area');
		    $table->integer('floor')->default('0');
		    $table->integer('finish_type')->default('0');
		    $table->integer('overlooks')->default('0');
		    $table->integer('payment_methods')->default('0');
		    $table->integer('rooms')->default('0');
		    $table->integer('bathrooms')->default('0');
		    $table->bigInteger('ad_id')->unique();
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
