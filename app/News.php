<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['title','small_description','content','banner','user_id','image'];
    public function User()
    {
        return $this->belongsTo(User::class ,'user_id','id');
    }
    protected $casts =[
        'title'=>'array',
        'small_description'=>'array',
        'content'=>'array',

    ];
}
