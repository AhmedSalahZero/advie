<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['title','description','link','image','page_id'];
    protected $casts = [
        'title'=>'array',
        'description'=>'array'
    ];
    public function section()
    {
        return $this->belongsTo(Page::class,'page_id','id');

    }

}
