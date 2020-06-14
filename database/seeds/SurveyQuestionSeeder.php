<?php

use Illuminate\Database\Seeder;
use App\Models\SurveyQuestion;



class SurveyQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'survey_id' => 1,
                'question_id' => 1
            ],
            [
                'survey_id' => 1,
                'question_id' => 2
            ],
            [
                'survey_id' => 1,
                'question_id' => 3
            ],
            [
                'survey_id' => 1,
                'question_id' => 4
            ],
            [
                'survey_id' => 1,
                'question_id' => 5
            ],
            [
                'survey_id' => 2,
                'question_id' => 6
            ],
            [
                'survey_id' => 2,
                'question_id' => 7
            ],
            [
                'survey_id' => 2,
                'question_id' => 8
            ],
            [
                'survey_id' => 2,
                'question_id' => 9
            ],
            [
                'survey_id' => 2,
                'question_id' => 10
            ],
            [
                'survey_id' => 3,
                'question_id' => 11
            ],
            [
                'survey_id' => 3,
                'question_id' => 12
            ],
            [
                'survey_id' => 3,
                'question_id' => 13
            ],
            [
                'survey_id' => 3,
                'question_id' => 14
            ],
            [
                'survey_id' => 3,
                'question_id' => 15
            ],
        ];
        SurveyQuestion::insert($data);
    }
}
