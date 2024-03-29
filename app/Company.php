<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'address', 'city', 'country', 'user_id'
    ];

    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
