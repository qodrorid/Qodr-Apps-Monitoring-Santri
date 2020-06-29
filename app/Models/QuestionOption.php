<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{

    public function randomOrder()
    {
        $this->inRandomOrder()->get();
    }

}
