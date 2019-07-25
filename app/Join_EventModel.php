<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Join_EventModel extends Model
{
    protected $table = "join_event";
    protected $fillable = ['Event_idEvent','Admin_idAdmin','User_NIP'];
    protected $primaryKey = 'idJoin';
    
    public function EventModel(){
        return $this->belongsTo('App\EventModel');
    }
    public function AdminModel(){
        return $this->belongsTo('App\AdminModel');
    }
}
