<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    //
    protected $fillable = [
        'name', 'complexity', 'duration', 'course_id'
    ];

    public function courses()
    {
        return $this->belongsTo('App\Course');
    }

}
