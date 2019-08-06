<?php

namespace App;

use App\Topic;
use App\Category;
use App\Rating;
use App\Comment;
use App\Test;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Return tests containng task
     *
     * @return BelongsToMany
     */
    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_task');
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

