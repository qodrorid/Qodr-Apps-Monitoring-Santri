<?php

use Illuminate\Database\Seeder;

class QuestionCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_categories')->insert([
            [
                'name' => 'Programming Surveys'
            ],
            [
                'name' => 'Social Surveys'
            ]
        ]);
    }
}
