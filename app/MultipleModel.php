<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultipleModel extends Model {

    protected $table = "multiple_choices";
    protected $fillable = ['Polling_idPolling','multiple_choice', 'total_multiple_choice'];
    protected $primaryKey = 'id_multiple_choice';

    public function PollingModel() {
        return $this->belongsTo('App\PollingModel');
    }

}
