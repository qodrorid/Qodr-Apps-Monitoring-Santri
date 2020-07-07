<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyUserDetail extends Model
{
    protected $fillable = ['survey_user_id','question_id','user_answer_id'];
}
