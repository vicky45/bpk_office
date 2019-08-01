<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_has_EventModel extends Model
{
    protected $table = "user_has_event";
    protected $fillable = ['Event_idEvent','User_NIP'];
    protected $primaryKey = 'idUser_has_Join';
    
    public function EventModel(){
        return $this->belongsTo('App\EventModel');
    }
    public function User(){
        return $this->belongsTo('App\User');
    }
    
}
