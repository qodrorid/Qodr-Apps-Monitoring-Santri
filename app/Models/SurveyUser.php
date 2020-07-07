<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyUser extends Model
{
    protected $fillable = [
        'survey_id',
        'santri_id',
        'time_count',
        'score',
    ];
}
