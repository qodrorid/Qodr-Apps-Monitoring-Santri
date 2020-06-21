<?php

use Illuminate\Database\Seeder;
use App\Models\QuestionCategory;



class QuestionCategorySeeder extends Seeder
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
                'name' => 'HTML'
            ],
            [
                'name' => 'CSS'
            ],
            [
                'name' => 'JAVASCRIPT'
            ]
        ];

        QuestionCategory::insert($data);
    }
}
