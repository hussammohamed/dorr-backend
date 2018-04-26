<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('family_name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();;
            $table->string('phone')->nullable();
            $table->string('mobile1')->unique();
            $table->string('mobile2')->nullable();

		    $table->integer('nationality')->nullable();
		    $table->string('address')->nullable();
		    $table->integer('id_type')->nullable();
		    $table->string('id_no')->nullable();
		    $table->integer('id_issuer')->nullable();
		    $table->date('id_issued_date')->nullable();
            $table->date('id_exp_date')->nullable();
            $table->date('id_exp_date')->nullable();
            $table->string('id_image')->nullable();
            
            $table->integer('bank')->nullable();
			$table->string('bank_iban')->nullable();

			$table->boolean('registered')->default('1');

            $table->string('lang')->nullable();
            $table->string('api_token',60)->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
