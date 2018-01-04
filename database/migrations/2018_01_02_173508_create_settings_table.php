<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
		    $table->string('site_name')->default(null);
		    $table->string('site_title_ar')->default(null);
		    $table->string('site_title_en')->default(null);
		    $table->string('full_domain')->default(null);
		    $table->longText('meta_keywords_ar');
		    $table->longText('meta_description_ar');
		    $table->longText('meta_keywords_en');
		    $table->longText('meta_description_en');
		    $table->string('email_no_reply')->default(null);
		    $table->string('email_contact')->default(null);
		    $table->string('copy_right_ar')->default(null);
		    $table->string('copy_right_en')->default(null);
		    $table->integer('website_status')->default(null);
		    $table->boolean('multilingual')->default(null);
		    $table->string('basic_language', 3)->default('1');
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
        Schema::dropIfExists('settings');
    }
}
