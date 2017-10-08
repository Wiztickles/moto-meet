<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function User(){
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function Meet(){
        return $this->belongsTo('\App\Meet', "meet_id");
    }
}
