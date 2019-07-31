<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollingModel extends Model
{
    protected $table = "polling";
    protected $fillable = ['Admin_idAdmin','Event_idEvent','type_polling','title_polling','status_polling'];
    protected $primaryKey = 'idPolling';
    
    public function AdminModel() {
        return $this->belongsTo('App\AdminModel');
    }
    public function EventModel() {
        return $this->belongsTo('App\EventModel');
    }
    public function RatingModel() {
        return $this->hasMany('App\RatingModel','Polling_idPolling','idPolling');
    }
    public function MultipletModel() {
        return $this->hasMany('App\MultipleModel','Polling_idPolling','idPolling');
    }
}
