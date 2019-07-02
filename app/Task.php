<?php

namespace App;

use App\Topic;
use App\Category;
use App\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{

    /**
     * Return tasks's topics
     *
     * @return BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'task_topic');
    }

    /**
     * Return tasks's categories
     *
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'task_category');
    }

    /**
     * Return task's ratings
     *
     * @return HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Return tasks's average rating
     *
     * @return float
     */
    public function averageRating()
    {
        return $this->ratings()->get()->avg('rating');
    }

    /**
     * Return tasks's ratings
     *
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


    public static function getTasks()
    {
        return static::query()->get();
    }


    public static function getTasksFromCurrentTeacher()
    {
        return static::query()->where('created_by', auth()->user()->id);
    }

    /**
     * Return all topics' IDs
     *
     * @return Collection
     */
    public static function getIDs(){
        return static::query()->pluck('id');
    }
}

