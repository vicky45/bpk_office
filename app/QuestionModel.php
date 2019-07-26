<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model {

    protected $table = "question";
    protected $fillable = ['idEvent', 'Speaker_idSpeaker', 'User_NIP', 'Admin_idAdmin', 'Event_idEvent', 'question', 'answer', 'reaction_like', 'reaction_dislike'];
    protected $primaryKey = 'idQuestion';

    public function EventModel() {
        return $this->belongsTo('App\EventModel');
    }

    public function SpeakerModel() {
        return $this->belongsTo('App\SpeakerModel');
    }

    public function AdminModel() {
        return $this->belongsTo('App\AdminModel');
    }

}
