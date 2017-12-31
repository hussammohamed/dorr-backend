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
        Schema::create('tbl_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
		    $table->integer('purpose');
		    $table->integer('ownerID');
		    $table->integer('region');
		    $table->decimal('lat', 9, 6);
		    $table->decimal('long', 9, 6);
		    $table->integer('type');
		    $table->text('description');
		    $table->integer('price');
		    $table->integer('pricePerMeter');
		    $table->date('dateOfConstruction');
		    $table->integer('area');
		    $table->integer('advertiserType');
		    $table->integer('floor');
		    $table->integer('finishType');
		    $table->integer('bathrooms');
		    $table->integer('rooms');
		    $table->integer('adID');
		    $table->string('youtube');
		    $table->string('address');
		    $table->date('startDate');
		    $table->date('endDate');
		    $table->boolean('featured');
		    $table->boolean('published');
		    $table->boolean('deleted');
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
        Schema::dropIfExists('tbl_properties');
    }
}
