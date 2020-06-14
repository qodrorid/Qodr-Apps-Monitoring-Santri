<?php

use Illuminate\Database\Seeder;

class SurveysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surveys')->insert([
            [
                'title' => 'PHP QUIZ',
                'author_id' => 9,
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d'),
                'time_limit' => 900,
                'note' => 'test'
            ],
            [
                'title' => 'JAVASCRIPT QUIZ',
                'author_id' => 9,
                'date_start' => date('Y-m-d'),
                'date_end' => date('Y-m-d'),
                'time_limit' => 900,
                'note' => 'test'
            ]
        ]);
    }
}
