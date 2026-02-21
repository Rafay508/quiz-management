<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->integer('duration_minutes');
            $table->integer('total_marks');
            $table->integer('pass_marks');
            $table->dateTime('expiry_date')->nullable();
            $table->integer('attempts_allowed')->default(1);
            $table->boolean('shuffle_questions')->default(false);
            $table->boolean('show_result_immediately')->default(false);
            $table->boolean('is_published')->default(false);
            $table->foreignId('created_by')->constrained('admins')->onDelete('cascade');
            $table->text('instructions')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
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
        Schema::dropIfExists('quizzes');
    }
}
