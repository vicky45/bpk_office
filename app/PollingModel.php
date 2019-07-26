<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollingModel extends Model
{
    protected $table = "polling";
    protected $fillable = ['Admin_idAdmin','User_NIP','multiple_choices_id_multiple_choice','Rating_idRating','Event_idEvent','type_polling','title_polling','status_polling'];
    protected $primaryKey = 'idPolling';
    
    public function AdminModel() {
        return $this->belongsTo('App\AdminModel');
    }
    public function EventModel() {
        return $this->belongsTo('App\EventModel');
    }
    public function RatingModel() {
        return $this->belongsTo('App\RatingModel');
    }
    public function MultipletModel() {
        return $this->belongsTo('App\MultipleModel');
    }
}
