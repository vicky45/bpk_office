<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
   public function artis(){
    	return $this->belongsTo('App\Artis');
    }
}
