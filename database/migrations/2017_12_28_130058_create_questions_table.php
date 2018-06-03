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
            $table->text('title');
            $table->string('question_type')->default('regular');
            $table->string('thumbnail')->nullable();
            $table->integer('number_of_answer')->default(4);
            $table->text('choice_a');
            $table->text('choice_b');
            $table->text('choice_c')->nullable();
            $table->text('choice_d')->nullable();
            $table->text('choice_e')->nullable();
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
