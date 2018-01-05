<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_links', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('menu_id');
		    $table->string('name_ar');
		    $table->string('name_en');
		    $table->string('link')->default('#');
		    $table->string('target')->default('_blank');
		    $table->integer('order');
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
        Schema::dropIfExists('menu_links');
    }
}
