<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model {

    protected $table = "admin";
    protected $fillable = ['Name_Admin'];
    protected $primaryKey = 'idAdmin';

    public function QuestionModel() {
        return $this->hasMany('App\QuestionModel', 'Admin_idAdmin', 'idAdmin');
    }

    public function Joint_EventModel() {
        return $this->hasMany('App\join_EventModel', 'Admin_idAdmin', 'idAdmin');
    }

}
