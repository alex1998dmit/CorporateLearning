<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'duration', 'complexity', 'company_id'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function curators()
    {
        return $this->hasMany('App\Curator');
    }

    public function blocks()
    {
        return $this->hasMany('App\Block');
    }
}
