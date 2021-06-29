<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Activity extends Model
{
    protected $guarded = [];

    public function oneUser()
    {
        return $this->belongsTo('App\User' , 'user_id');
    }
}
