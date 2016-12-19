<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'related_id',
        'related_to',
        'path',
    ];

    public function scopeRelatedTo($query, $related = '')
    {
        return $query->where('related_to', $related);
    }

    public function getPathAttribute($path) {
        return 'http://api.boykotvar.dev' . str_replace(storage_path(), '', $path);
    }
}
