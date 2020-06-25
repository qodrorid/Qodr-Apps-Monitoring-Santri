<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyUserDetails extends Migration
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
