<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = "event";
    protected $fillable = ['code_event','name_event','date_event','time_event','status_event','location','user_created'];
    protected $primaryKey = 'idEvent';
    
    public function SpeakerModel(){
        return $this->hasMany('App\SpeakerModel','idEvent','idEvent');//idEvent pertama untuk penamaan tabel anak 
    }                                                                 //idEvent ke2 untuk penamaan primary key local
    
    public function QuestionModel(){
        return $this->hasMany('App\QuestionModel','idEvent','idEvent');
    }
    
}
