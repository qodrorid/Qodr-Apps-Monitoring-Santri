<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('santri_id');
            $table->integer('time_count');
            $table->integer('score')->nullable();
            $table->timestamps();

            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
            $table->foreign('santri_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_users');
    }
}
