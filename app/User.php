<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $primaryKey = 'NIP';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function Join_EventModel(){
        return $this->hasMany('App\Join_EventModel','User_NIP','NIP');
    }
    public function QuestionModel(){
        return $this->hasMany('App\QuestionModel','User_NIP','NIP');
    }
    
}
