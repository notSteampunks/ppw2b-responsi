<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'comments';
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function homestay()
    {
        return $this->belongsTo('App\Homestay', 'id_homestay', 'id');
    }
}
