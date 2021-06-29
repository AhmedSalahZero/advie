<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $casts = [
        'name' => 'array' ,
        'content' => 'array'
    ];
    public function page()
    {
        return $this->belongsTo(Page::class,'page_id','id');
    }
}
