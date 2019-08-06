<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded  = [];

    /**
     * Return test's tasks
     *
     * @return BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'test_task');
    }


    /**
     * Return if test can be deleted (belongs to authorised user, not solved yet)
     *
     * @return bool
     */
    public function canDelete()
    {
        return true;
        //nikto ho este neriesil
    }

    /**
     * Return whether the test's author is authenticated
     *
     * @return bool
     */
    public function authIsMyAuthor(){
        return ($this->teacher_id == auth()->user()->id);
    }

    /**
     * Return date in string format d. m. Y
     * @return string
     */
    public function dateToString($date) {
        return date('d. m. Y H : i' , $date->getTimestamp());
    }
}
