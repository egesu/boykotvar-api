<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoycottUser extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Model\User::class);
    }

    public function boycott()
    {
        return $this->belongsTo(\App\Model\Boycott::class);
    }
}
