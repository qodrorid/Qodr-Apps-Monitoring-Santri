<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRabDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rab_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rab_id');
            $table->string('for');
            $table->integer('qty');
            $table->string('type');
            $table->integer('price');
            $table->integer('total');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rab_id')->references('id')->on('rabs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rab_details');
    }
}
