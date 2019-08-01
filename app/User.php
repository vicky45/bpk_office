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
    
    public function User_has_EventModel(){
        return $this->hasMany('App\User_has_EventModel','User_NIP','NIP');
    }
    
    public function AdminModel(){
        return $this->hasOne('App\AdminModel','User_NIP','NIP');
    }
    
    public function QuestionModel(){
        return $this->hasMany('App\QuestionModel','User_NIP','NIP');
    }
    
}
