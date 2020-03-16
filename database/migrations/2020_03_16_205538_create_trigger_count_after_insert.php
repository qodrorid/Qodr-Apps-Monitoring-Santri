<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerCountAfterInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER `count_after_insert` AFTER INSERT ON `rab_details` FOR EACH ROW BEGIN set @total =(SELECT SUM(`total`) FROM `rab_details` WHERE `rab_id` = new.rab_id); UPDATE `rabs` SET `total` = @total WHERE `id` = new.rab_id; END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `count_after_insert`');
    }
}
