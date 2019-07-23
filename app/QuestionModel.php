<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    protected $table = "question";
    protected $fillable = ['idEvent','NIP','idSpeaker','question','answer','reaction_like','reaction_dislike'];
    protected $primaryKey = 'idQuestion';
    
    public function EventModel(){
        return $this->belongsTo('App\EventModel');
    }
    
}
