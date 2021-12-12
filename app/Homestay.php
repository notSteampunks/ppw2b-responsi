<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    protected $table = 'listhomestay';
    
    public function photos(){
        return $this->belongsTo('App\Galeri', 'id_homestay', 'id');
    }
}
