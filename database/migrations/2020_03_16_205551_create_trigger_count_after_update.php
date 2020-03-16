<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerCountAfterUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER `count_after_update` AFTER UPDATE ON `rab_details` FOR EACH ROW BEGIN set @total =(SELECT SUM(`total`) FROM `rab_details` WHERE `rab_id` = old.rab_id); UPDATE `rabs` SET `total` = @total WHERE `id` = old.rab_id; END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `count_after_update`');
    }
}
