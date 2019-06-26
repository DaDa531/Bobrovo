<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelonsTo;
use Illuminate\Database\Eloquent\Relations\BelonsToMany;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'created_by'];


    /**
     * Return group's user (author)
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(App\User, 'created_by');
    }

    /**
     * Return group's students
     *
     * @return BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany('App\Student', 'student_group');
    }

    public function studentsCount()
    {
        return $this->students()->count();
    }

    /**
     * Return current teacher's groups
     *
     * @return Builder|Model
     */
    public static function getGroupsFromCurrentTeacher()
    {
        return static::query()->where('created_by', auth()->user()->id);
    }

    /**
     * Return if group can be deleted (no students assigned)
     *
     * @return bool
     */
    public function canDelete()
    {
        return true;
        /*
        if ($this->studentsCount() != 0)
            return False;

        return true;*/
    }

}
