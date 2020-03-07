<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileSantrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_santris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name', 32);
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('phone', 15)->nullable();
            $table->text('address')->nullable();
            $table->string('father_name', 32)->nullable();
            $table->string('father_phone', 15)->nullable();
            $table->text('father_address')->nullable();
            $table->string('mother_name', 32)->nullable();
            $table->string('mother_phone', 15)->nullable();
            $table->text('mother_address')->nullable();
            $table->enum('status', ['santri', 'magang', 'mentor'])->default('santri');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_santris');
    }
}
