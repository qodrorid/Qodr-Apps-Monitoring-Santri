<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashFlowDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_flow_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cash_flow_id');
            $table->date('date');
            $table->string('for');
            $table->integer('qty');
            $table->string('type');
            $table->integer('price');
            $table->integer('debit')->default(0);
            $table->integer('kredit')->default(0);
            $table->timestamps();
            $table->foreign('cash_flow_id')->references('id')->on('cash_flows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_flow_details');
    }
}
