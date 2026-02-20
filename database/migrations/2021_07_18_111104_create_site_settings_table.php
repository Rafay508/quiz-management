<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_title')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('pinterest')->nullable();
            $table->text('footer_sentence')->nullable();
            $table->text('copyright')->nullable();
            $table->text('google_adsense_script')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('term_condition')->nullable();
            $table->longText('header_script')->nullable();
            $table->longText('footer_script')->nullable();
            $table->longText('home_banner')->nullable();
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
        Schema::dropIfExists('site_settings');
    }
}
