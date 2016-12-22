<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoycottConcern extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'boycott_id',
        'concern_id',
    ];

    public function boycott()
    {
        return $this->belongsTo(\App\Model\Boycott::class);
    }

    public function concern()
    {
        return $this->belongsTo(\App\Model\Concern::class);
    }
}
