<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultipleModel extends Model {

    protected $table = "multiple_choices";
    protected $fillable = ['multiple_choice', 'total_multiple_choice'];
    protected $primaryKey = 'id_multiple_choice';

    public function PollingModel() {
        return $this->hasMany('App\PollingModel', 'multiple_choices_id_multiple_choice', 'id_multiple_choice');
    }

}
