<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title','description','image','banner'];
    protected $casts = [
        'title'=>'array',
        'description'=>'array',
    ];


}
