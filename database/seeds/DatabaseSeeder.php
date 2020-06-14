<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(QuestionCategorieSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SurveysSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(SurveyQuestionSeeder::class);
        $this->call(QuestionOptionSeeder::class);
        // $this->call(SettingSeeder::class);
    }
}
