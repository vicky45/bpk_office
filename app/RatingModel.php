<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingModel extends Model
{
    protected $table = "rating";
    protected $fillable = ['idRating','rating', 'total_rating'];
    protected $primaryKey = 'idRating';
    
    
     public function PollingModel(){
        return $this->hasMany('App\PollingModel','multiple_choices_id_multiple_choice','id_multiple_choice');
    }
}
