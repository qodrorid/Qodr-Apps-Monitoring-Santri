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
        DB::unprepared('CREATE TRIGGER `count_after_update_rab` AFTER UPDATE ON `rab_details` FOR EACH ROW BEGIN set @total =(SELECT COALESCE(SUM(`total`),0) FROM `rab_details` WHERE `rab_id` = new.rab_id); UPDATE `rabs` SET `total` = @total WHERE `id` = new.rab_id; END');
        DB::unprepared('CREATE TRIGGER `count_after_update_cash_flow` AFTER UPDATE ON `cash_flow_details` FOR EACH ROW BEGIN set @debit =(SELECT COALESCE(SUM(`debit`), 0) FROM `cash_flow_details` WHERE `cash_flow_id` = new.cash_flow_id); set @kredit = (SELECT COALESCE(SUM(`kredit`), 0) FROM `cash_flow_details` WHERE `cash_flow_id` = new.cash_flow_id); set @total = @debit - @kredit; UPDATE `cash_flows` SET `debit` = @debit, `kredit` = @kredit, `total` = @total WHERE `id` = new.cash_flow_id; END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `count_after_update_rab`');
        DB::unprepared('DROP TRIGGER IF EXISTS `count_after_update_cash_flow`');
    }
}
