<?php

namespace App;

use App\Topic;
use App\Category;
use App\Rating;
use App\Comment;
use App\Test;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Task extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded  = [];

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
        return round($this->ratings()->get()->avg('rating'), 1);
    }

    /**
     * Return tasks's ratings
     *
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * Return tests containing task
     *
     * @return BelongsToMany
     */
    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_task');
    }


    /**
     * Return current teacher's tasks
     *
     * @return Builder|Model
     */
    public static function getTasks()
    {
        return static::query()->where('created_by', auth()->id());
    }


    /**
     * Return test's tasks except $array
     *
     * @return Builder|Model
     */
    public static function getTasksExcept($array)
    {
        return static::query()->whereNotIn('id', $array);
    }

    /**
     * Scope a query to only include tasks of given categories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCategories($query, $categories){
        if (!$categories)
            return $query;
        $ids = DB::table('task_category')->whereIn('category_id', $categories)->pluck('task_id');
        return $query->whereIn('id', $ids);
    }

    /**
     * Scope a query to only include tasks of given topics.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfTopics($query, $topics){
        if (!$topics)
            return $query;
        $ids = DB::table('task_topic')->whereIn('topic_id', $topics)->pluck('task_id');
        return $query->whereIn('id', $ids);
    }

    /**
     * Scope a query to only include tasks of given types.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfTypes($query, $types){
        if (!$types)
            return $query;
        return $query->whereIn('type', $types);
    }

    /**
     * Return if task can be deleted (belongs to authorised user, not in test)
     *
     * @return bool
     */
    public function canDelete()
    {
        //doplnit testy, ci uloha nie je v nejakom teste

        if ($this->created_by != auth()->user()->id)
            return False;

        return true;
    }

    /**
     * Return whether the tasks's author is authenticated
     *
     * @return bool
     */
    public function authIsMyAuthor(){
        return ($this->created_by == auth()->user()->id);
    }
}

