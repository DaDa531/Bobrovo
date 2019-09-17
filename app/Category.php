<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'class'];


    /**
     * Return tasks in the category
     *
     * @return BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_category');
    }
}
