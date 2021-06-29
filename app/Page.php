<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name' , 'content'];
    protected $casts = ['name' => 'array' , 'content' => 'array'];
    public function childs()
    {
        return $this->hasMany(Page::class);
    }
    public function sliders()
    {
        return $this->hasMany(Slider::class,'page_id','id');

    }
    public function sections()
    {
        return $this->hasMany(Section::class,'page_id','id');

    }
}
