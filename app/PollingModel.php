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
        return $this->hasMany('App\RatingModel','polling_idPolling','idPolling');
    }
    public function MultipleModel() {
        return $this->hasMany('App\MultipleModel','polling_idPolling','idPolling');
    }
}
