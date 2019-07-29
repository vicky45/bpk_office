<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model {

    protected $table = "question";
    protected $fillable = ['Speaker_idSpeaker', 'User_NIP', 'Admin_idAdmin', 'Event_idEvent', 'question', 'answer', 'status' , 'reaction_like', 'reaction_dislike'];
    protected $primaryKey = 'idQuestion';

    public function EventModel() {
        return $this->belongsTo('App\EventModel');
    }

    public function SpeakerModel() {
        return $this->belongsTo('App\SpeakerModel','Speaker_idSpeaker','idSpeaker');
    }

    public function AdminModel() {
        return $this->belongsTo('App\AdminModel','Admin_idAdmin');
    }
    
    public function user(){
        return $this->belongsTo('App\user','User_NIP','NIP');
    }

}
