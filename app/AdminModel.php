<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model {

    protected $table = "admin";
    protected $fillable = ['User_NIP','Name_Admin','Event_idEvent'];
    protected $primaryKey = 'idAdmin';

    
    
    public function QuestionModel() {
        return $this->hasMany('App\QuestionModel', 'Admin_idAdmin', 'idAdmin');
    }
    
    public function User() {
        return $this->belongsTo('App\User');
    }

    public function EventModel() {
        return $this->belongsTo('App\EventModel');
    }

}
