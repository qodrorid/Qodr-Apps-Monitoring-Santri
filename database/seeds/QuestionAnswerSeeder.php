<?php

use App\Models\QuestionAnswer;
use Illuminate\Database\Seeder;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // question answer
        $answer_data = [
            [ 'question_id' => 1, 'option_id' => 3],
            [ 'question_id' => 2, 'option_id' => 8],
            [ 'question_id' => 3, 'option_id' => 12],
            [ 'question_id' => 4, 'option_id' => 15],
            [ 'question_id' => 5, 'option_id' => 17],
            [ 'question_id' => 6, 'option_id' => 22],
            [ 'question_id' => 7, 'option_id' => 27],
            [ 'question_id' => 8, 'option_id' => 30],
            [ 'question_id' => 9, 'option_id' => 35],
            [ 'question_id' => 10, 'option_id' => 38],
            [ 'question_id' => 11, 'option_id' => 41],
            [ 'question_id' => 12, 'option_id' => 47],
            [ 'question_id' => 13, 'option_id' => 49],
            [ 'question_id' => 14, 'option_id' => 55],
            [ 'question_id' => 15, 'option_id' => 58]
        ];

        QuestionAnswer::insert($answer_data);
    }
}
