<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoycottPost extends Model
{

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function boycott()
    {
        return $this->belongsTo('App\Boycott');
    }
}
