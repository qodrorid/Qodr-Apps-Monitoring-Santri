<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'note',
        'is_active',
        'author_id'
    ];


    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }



}
