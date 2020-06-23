<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('survey_user_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('user_answer_id');
            $table->timestamps();

            $table->foreign('survey_user_id')->references('id')->on('survey_users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('user_answer_id')->references('id')->on('questions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_user_details');
    }
}
