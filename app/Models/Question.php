<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'note',
        'is_active',
        'author_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Question $item) {
            $item->author_id = Auth::user()->id;
            $item->created_at = date('Y-m-d H:i:s');
        });



        static::updating(function (Question $item) {
            $item->author_id = Auth::user()->id;
            $item->updated_at = date('Y-m-d H:i:s');
        });
    }


    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
