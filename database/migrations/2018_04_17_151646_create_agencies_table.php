<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('user_id')->nullable();
            $table->string('commercial_register_name')->nullable();
            $table->string('commercial_register_no')->nullable();
		    $table->integer('commercial_register_issuer')->nullable();
		    $table->date('commercial_register_date')->nullable();
            $table->date('commercial_register_exp_date')->nullable();
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
        Schema::dropIfExists('agencies');
    }
}
