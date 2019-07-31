<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingModel extends Model
{
    protected $table = "rating";
    protected $fillable = ['polling_idPolling','rating', 'total_rating'];
    protected $primaryKey = 'idRating';
    
    
     public function PollingModel(){
        return $this->belongsTo('App\PollingModel');
    }
}
