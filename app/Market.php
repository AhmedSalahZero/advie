<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = ['title','content','banner','image'];
    protected $casts = [
        'title'=>'array',
        'content'=>'array'
    ];
}
