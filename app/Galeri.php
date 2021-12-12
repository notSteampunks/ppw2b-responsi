<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    public function albums(){
        return $this->belongsTo('App\Homestay', 'id_homestay', 'id');
    }
}
