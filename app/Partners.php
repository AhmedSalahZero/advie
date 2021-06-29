<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    protected $fillable=['name','position','image'];
    protected $casts =[
        'name'=>'array',
        'position'=>'array'
    ];
}
