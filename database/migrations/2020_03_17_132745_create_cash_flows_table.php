<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_flows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rab_id')->nullable();
            $table->unsignedInteger('branch_id');
            $table->date('date');
            $table->string('month', 10);
            $table->string('year', 4);
            $table->integer('debit')->default(0);
            $table->integer('kredit')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();
            $table->foreign('rab_id')->references('id')->on('rabs')->onDelete('set null');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_flows');
    }
}
