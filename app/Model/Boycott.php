<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boycott extends Model
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
        'title',
        'description',
        'created_by_id',
    ];

    protected $appends = [
        'users_count',
    ];

    public function boycottUsers()
    {
        return $this->hasMany(\App\Model\BoycottUser::class);
    }

    public function boycottUsersCount()
    {
        return $this->hasOne(\App\Model\BoycottUser::class)
            ->selectRaw('boycott_id, COUNT(*) AS aggregate')
            ->groupBy('boycott_id');
    }

    public function posts()
    {
        return $this->hasMany(\App\Model\BoycottPost::class);
    }

    public function coverImage()
    {
        return $this->hasOne(\App\Model\Media::class, 'related_id')
            ->relatedTo('boycott_cover_image');
    }

    public function boycottConcerns()
    {
        return $this->hasMany(\App\Model\BoycottConcern::class);
    }

    public function getUsersCountAttribute()
    {
        if (!array_key_exists('boycottUsersCount', $this->relations)) {
            return null;
        }

        $related = $this->getRelation('boycottUsersCount');
        return $related ? (int)$related->aggregate : 0;
    }
}
