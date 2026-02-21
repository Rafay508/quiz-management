<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuizSettingsToSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->integer('max_attempts_allowed')->default(1)->after('home_banner');
            $table->boolean('shuffle_questions')->default(false)->after('max_attempts_allowed');
            $table->boolean('shuffle_options')->default(false)->after('shuffle_questions');
            $table->boolean('show_result_immediately')->default(false)->after('shuffle_options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'max_attempts_allowed',
                'shuffle_questions',
                'shuffle_options',
                'show_result_immediately'
            ]);
        });
    }
}
