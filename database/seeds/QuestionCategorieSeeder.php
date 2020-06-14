<?php

use Illuminate\Database\Seeder;
use App\Models\QuestionCategorie;


class QuestionCategorieSeeder extends Seeder
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

        QuestionCategorie::insert($data);
    }
}
