<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('title');
            $table->string('question_type')->default('regular');
            $table->string('thumbnail')->nullable();
            $table->integer('number_of_answer')->default(4);
            $table->string('choice_a');
            $table->string('choice_b');
            $table->string('choice_c')->nullable();
            $table->string('choice_d')->nullable();
            $table->string('answer');
            $table->text('explanation')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('questions');
    }
}
