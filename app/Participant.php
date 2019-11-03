<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //
    protected $fillable = [
        'user_id', 'birthday_date', 'grade'
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
