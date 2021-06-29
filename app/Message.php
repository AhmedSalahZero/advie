<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name','subject','message' , 'email','status'];
    public function setNameAttribute($value)
    {
        $this->attributes['name']=trim(strip_tags($value)) ;
    }
    public function setSubjectAttribute($value)
    {
        $this->attributes['subject']=trim(strip_tags($value)) ;
    }
    public function setMessageAttribute($value)
    {
        $this->attributes['message']=trim(strip_tags($value)) ;
    }
    public function setEmailAttribute($value)
    {
        $this->attributes['email']=trim(strip_tags($value)) ;
    }



}
