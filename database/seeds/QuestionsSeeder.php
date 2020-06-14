<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // category
        DB::table('question_categories')->insert([
            [
                'name' => 'Programming Surveys'
            ],
            [
                'name' => 'Social Surveys'
            ]
        ]);

        // question
        // DB::table('questions')->insert([
        //     [
        //         'name' => 'Programming Surveys'
        //     ],
        //     [
        //         'name' => 'Social Surveys'
        //     ]
        // ]);

        // options
        // DB::table('question_categories')->insert([
        //     [
        //         'name' => 'Programming Surveys'
        //     ],
        //     [
        //         'name' => 'Social Surveys'
        //     ]
        // ]);
    }
}
