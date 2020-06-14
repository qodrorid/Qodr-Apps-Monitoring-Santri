<?php

use Illuminate\Database\Seeder;
use App\Models\Survey;


class SurveysSeeder extends Seeder
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
            'title'         => 'UJI WAWASAN PEMBELAJARAN HTML',
            'author_id'     => 9,
            'date_start'    => date('Y-m-d'),
            'date_end'      => date('Y-m-d'),
            'time_limit'    => 10,
            'note'          => 'Terus lah berlatih'
            ],
            [
                'title'         => 'UJI WAWASAN PEMBELAJARAN CSS',
                'author_id'     => 9,
                'date_start'    => date('Y-m-d'),
                'date_end'      => date('Y-m-d'),
                'time_limit'    => 10,
                'note'          => 'Terus lah berlatih'
            ],
            [
                'title'         => 'UJI WAWASAN PEMBELAJARAN JAVASCRIPT',
                'author_id'     => 9,
                'date_start'    => date('Y-m-d'),
                'date_end'      => date('Y-m-d'),
                'time_limit'    => 10,
                'note'          => 'Terus lah berlatih'
            ]

        ];

        Survey::insert($data);
    }
}
