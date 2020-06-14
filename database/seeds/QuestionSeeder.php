<?php

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
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
                'title' => 'What does HTML stand for?',
                'category_id'=> 1,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'Who is making the Web standards?',
                'category_id'=> 1,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'Choose the correct HTML element for the largest heading:',
                'category_id'=> 1,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'What is the correct HTML element for inserting a line break?',
                'category_id'=> 1,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'What is the correct HTML for adding a background color?',
                'category_id'=> 1,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'What does CSS stand for?',
                'category_id'=> 2,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'What is the correct HTML for referring to an external style sheet?',
                'category_id'=> 2,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'Where in an HTML document is the correct place to refer to an external style sheet?',
                'category_id'=> 2,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'Which HTML tag is used to define an internal style sheet?',
                'category_id'=> 2,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'Which HTML attribute is used to define inline styles?',
                'category_id'=> 2,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'Inside which HTML element do we put the JavaScript?',
                'category_id'=> 3,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'What is the correct JavaScript syntax to change the content of the HTML element below?

                <p id="demo">This is a demonstration.</p>',
                'category_id'=> 3,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'Where is the correct place to insert a JavaScript?',
                'category_id'=> 3,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'What is the correct syntax for referring to an external script called "xxx.js"?',
                'category_id'=> 3,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
            [
                'title' => 'How do you write "Hello World" in an alert box?',
                'category_id'=> 3,
                'note' => 'mantap',
                'is_active' => true,
                'author_id' => 9
            ],
        ];

        Question::insert($data);
    }
}
