<?php

use Illuminate\Database\Seeder;
use App\Models\QuestionOption;


class QuestionOptionSeeder extends Seeder
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
                'question_id' => 1,
                'answer' => 'Hperlink and Text Markup Language'
            ],
            [
                'question_id' => 1,
                'answer' => 'Home Tool Markup Language'
            ],
            [
                'question_id' => 1,
                'answer' => 'Hyper Text Markup Language'
            ],
            [
                'question_id' => 1,
                'answer' => 'Hyper Tool Markup Language'
            ],
            [
                'question_id' => 2,
                'answer' => 'Microsoft'
            ],
            [
                'question_id' => 2,
                'answer' => 'Google'
            ],
            [
                'question_id' => 2,
                'answer' => 'Mozila'
            ],
            [
                'question_id' => 2,
                'answer' => 'The World Wide Web Consortium'
            ],
            [
                'question_id' => 3,
                'answer' => '<h6>'
            ],
            [
                'question_id' => 3,
                'answer' => '<heading>'
            ],
            [
                'question_id' => 3,
                'answer' => '<head>'
            ],
            [
                'question_id' => 3,
                'answer' => '<h1>'
            ],
            [
                'question_id' => 4,
                'answer' => '<break>'
            ],
            [
                'question_id' => 4,
                'answer' => '<lb>'
            ],
            [
                'question_id' => 4,
                'answer' => '<br>'
            ],
            [
                'question_id' => 4,
                'answer' => '<bold>'
            ],
            [
                'question_id' => 5,
                'answer' => '<body style="background-color:yellow">'
            ],
            [
                'question_id' => 5,
                'answer' => '<background>yellow</background>'
            ],
            [
                'question_id' => 5,
                'answer' => '<body bg="yellow">'
            ],
            [
                'question_id' => 5,
                'answer' => '<body style="red">'
            ],
            [
                'question_id' => 6,
                'answer' => 'Creative Style Sheets'
            ],
            [
                'question_id' => 6,
                'answer' => 'Cascading Style Sheets'
            ],
            [
                'question_id' => 6,
                'answer' => 'Computer Style Sheets'
            ],
            [
                'question_id' => 6,
                'answer' => 'Colorful Style Sheedts'
            ],
            [
                'question_id' => 7,
                'answer' => '<style src ="mystyle.css">'
            ],
            [
                'question_id' => 7,
                'answer' => '<stylesheet>mystyle.css</stylesheet>'
            ],
            [
                'question_id' => 7,
                'answer' => '<link  rel="stylesheet" type="text/css" href="mystyle.css">'
            ],
            [
                'question_id' => 7,
                'answer' => '<a href="mystyle.css">'
            ],
            [
                'question_id' => 8,
                'answer' => 'At the end of the document'
            ],
            [
                'question_id' => 8,
                'answer' => 'in the <head> section'
            ],
            [
                'question_id' => 8,
                'answer' => 'in the <body> section'
            ],
            [
                'question_id' => 8,
                'answer' => 'in hte <footer> section'
            ],
            [
                'question_id' => 9,
                'answer' => '<script>'
            ],
            [
                'question_id' => 9,
                'answer' => '<css>'
            ],
            [
                'question_id' => 9,
                'answer' => '<style>'
            ],
            [
                'question_id' => 9,
                'answer' => '<sheet>'
            ],
            [
                'question_id' => 10,
                'answer' => 'styles'
            ],
            [
                'question_id' => 10,
                'answer' => 'style'
            ],
            [
                'question_id' => 10,
                'answer' => 'font'
            ],
            [
                'question_id' => 10,
                'answer' => 'class'
            ],
            [
                'question_id' => 11,
                'answer' => '<script>'
            ],
            [
                'question_id' => 11,
                'answer' => '<js>'
            ],
            [
                'question_id' => 11,
                'answer' => '<javascript>'
            ],
            [
                'question_id' => 11,
                'answer' => '<scripting>'
            ],
            [
                'question_id' => 12,
                'answer' => 'document.getElementByName("p").innerHTML = "Hello World!";'
            ],
            [
                'question_id' => 12,
                'answer' => 'document.getElement("p").innerHTML = "Hello World!";'
            ],
            [
                'question_id' => 12,
                'answer' => 'document.getElementById("demo").innerHTML = "Hello World!";'
            ],
            [
                'question_id' => 12,
                'answer' => 'document.innerHTML = "Hello World!";'
            ],
            [
                'question_id' => 13,
                'answer' => 'Both the<head> section and the <body> section are correct'
            ],
            [
                'question_id' => 13,
                'answer' => 'The<head>section'
            ],
            [
                'question_id' => 13,
                'answer' => 'The<body>section'
            ],
            [
                'question_id' => 13,
                'answer' => 'The<footer>section'
            ],
            [
                'question_id' => 14,
                'answer' => '<script name="xxx.js">'
            ],
            [
                'question_id' => 14,
                'answer' => '<script href="xxx.js">'
            ],
            [
                'question_id' => 14,
                'answer' => '<script src="xxx.js">'
            ],
            [
                'question_id' => 14,
                'answer' => '<script image="xxx.js">'
            ],
            [
                'question_id' => 15,
                'answer' => 'msgBox("Hello World")'
            ],
            [
                'question_id' => 15,
                'answer' => 'alert("Hello World")'
            ],
            [
                'question_id' => 15,
                'answer' => 'alertBox("Hello World")'
            ],
            [
                'question_id' => 15,
                'answer' => 'msg("Hello World")'
            ],


           
        ];

        QuestionOption::insert($data);
    }
}
