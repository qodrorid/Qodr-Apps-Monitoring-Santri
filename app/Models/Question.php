<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'author_id',
    ];
    
    // public function boot()
    // {
    //     // add author_id & created_at field
    //     static::creating(function(Question $item){
    //         $item->author->id = Auth::user()->id;
    //         $item->created_at = date('Y-m-d H:i:s');
    //     });

    //     // update author_id & created_at field
    //     static::updating(function(Question $item){
    //         $item->author->id = Auth::user()->id;
    //         $item->created_at = date('Y-m-d H:i:s');
    //     });
    // }

    public function kategori()
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
