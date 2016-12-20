<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concern extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected $fillable = [
        'name',
    ];

    public function boycottConcerns()
    {
        return $this->hasMany('App\BoycottConcern');
    }

    public function image()
    {
        return $this->hasOne('App\Media', 'related_id')
            ->relatedTo('concern_logo');
    }
}
