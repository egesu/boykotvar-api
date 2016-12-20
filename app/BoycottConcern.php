<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoycottConcern extends Model
{
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
        return $this->belongsTo('App\Boycott');
    }

    public function concern()
    {
        return $this->belongsTo('App\Concern');
    }
}
