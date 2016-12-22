<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoycottPost extends Model
{

    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function boycott()
    {
        return $this->belongsTo(\App\Model\Boycott::class);
    }
}
