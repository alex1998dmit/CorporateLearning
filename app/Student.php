<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'participant_id', 'course_id'
    ];

    public function company()
    {
        return $this->belongsTo('App\Course');
    }

    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }
}
