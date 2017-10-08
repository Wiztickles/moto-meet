<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'city', 'motorcycle', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Comments(){
        return $this->hasMany('\App\Comment', 'user_id');
    }

    public function Meets(){
        return $this->hasMany('\App\Meet', 'user_id');
    }

    public function Attends(){
        return $this->hasMany('\App\Attend', 'user_id');
    }

}
