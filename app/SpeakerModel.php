<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpeakerModel extends Model
{
    protected $table = "speaker";
    protected $fillable = ['idEvent' , 'name_speaker'];
    protected $primaryKey = 'idSpeaker';
    
    public function EventModel(){
        return $this->belongsTo('App\EventModel');
    }
        
}
