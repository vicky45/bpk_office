<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpeakerModel extends Model
{
    protected $table = "speaker";
    protected $fillable = ['Event_idEvent' , 'name_speaker'];
    protected $primaryKey = 'idSpeaker';
    
    
    public function EventModel(){
        return $this->belongsTo('App\EventModel');
    }
     public function QuestionModel(){
        return $this->hasMany('App\QuestionModel','Speaker_idSpeaker','idSpeaker');
    }   
}
