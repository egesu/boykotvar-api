<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

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
