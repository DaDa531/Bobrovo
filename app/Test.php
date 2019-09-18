<?php

namespace App;

use App\Assignment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Return all group_assignments of the test
     *
     * @return BelongsToMany
     */

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    /**
     * Return current teacher's tests
     *
     * @return Builder|Model
     */
    public static function getTests()
    {
        return static::query()->where('teacher_id', auth()->id());
    }


    /**
     * Return whether the test's author is authenticated
     *
     * @return bool
     */
    public function authIsMyAuthor(){
        return ($this->teacher_id == auth()->id());
    }

    /**
     * Return given date in string format d. m. Y
     * @return string
     */
    public function dateToString($date) {
        return $date->isoFormat('DD. MM. YYYY');
    }

    /**
     * Return whether the test is assigned to some group
     * @return boolean
     */
    public function isAssigned() {
        return $this->assignments()->first() != null;
    }

    /**
     * Return whether the test is already solved (some results of the test are saved)
     * @return boolean
     */
    public function isSolved() {
        return false;
    }

    /**
     * Return if test can be deleted (belongs to authorised user, not solved yet)
     *
     * @return bool
     */
    public function canDelete()
    {
        return !$this->isAssigned();
        //nikto ho este neriesil
    }

    /**
     * Return whether the test's author is authenticated
     * @return bool
     */
    public function authIsMyTeacher(){
        return ($this->teacher_id == auth()->user()->id);
    }
}
