<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->text('answer_1');
            $table->text('answer_2');
            $table->text('answer_3');
            $table->text('answer_4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_content');
    }
}
