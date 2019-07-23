<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Join_EventModel extends Model
{
    protected $table = "join_event";
    protected $fillable = ['idEvent','NIP'];
    protected $primaryKey = 'idEvent';
}
