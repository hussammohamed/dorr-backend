<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
		    $table->string('title_ar');
		    $table->string('title_en');
		    $table->longText('full_content_ar');
		    $table->longText('full_content_en');
		    $table->text('short_content_ar');
		    $table->text('short_content_en');
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
        Schema::dropIfExists('pages');
    }
}
