<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
   public function MeetComments(){
       return $this->hasMany('\App\Comment', 'meet_id');
   }

   public function User(){
       return $this->belongsTo('\App\User');
   }
}
