<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('multiple_question_id');
            $table->unsignedBigInteger('multiple_answer_id');
            $table->unsignedBigInteger('survey_id');
            $table->string('answer_name');
            $table->longText('question_name');
            $table->longText('eval_name');
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
        Schema::dropIfExists('evaluation_responses');
    }
};
