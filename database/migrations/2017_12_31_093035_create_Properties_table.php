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
		    $table->integer('m_property_id')->nullable();
		    $table->integer('advertiser_type')->nullable();
		    $table->integer('type');
		    $table->integer('purpose');
            $table->string('title');
		    $table->string('address');
		    $table->integer('region');
		    $table->decimal('lat', 20, 18);
		    $table->decimal('long', 20, 18);
		    $table->integer('map_view')->nullable();
		    $table->text('description')->nullable();
		    $table->integer('price');
		    $table->integer('price_view')->nullable();
		    $table->integer('bid_price')->nullable();
		    $table->integer('period')->nullable();
		    $table->integer('income')->nullable();
		    $table->integer('year_of_construction')->nullable();
		    $table->integer('area')->nullable();
		    $table->integer('floor')->nullable();
		    $table->integer('finish_type')->nullable();
		    $table->string('overlooks')->nullable();
		    $table->integer('payment_methods')->nullable();
		    $table->integer('rooms')->nullable();
		    $table->integer('bathrooms')->nullable();
		    $table->bigInteger('ad_id')->unique();
		    $table->integer('hits')->default('0');
		    $table->string('youtube')->nullable();
		    $table->boolean('allow_comments')->default('1');
		    $table->boolean('allow_whatsapp')->default('1');
		    $table->boolean('allow_private')->default('1');
		    $table->date('startDate')->nullable();
		    $table->date('endDate')->nullable();
		    $table->date('data_updated')->nullable();
		    $table->boolean('marked')->default('1');
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
