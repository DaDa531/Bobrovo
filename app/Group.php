<?php

namespace App;

use App\User;
use App\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Return group's students
     *
     * @return BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_group');
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
    public static function getGroups()
    {
        return static::query()->where('created_by', auth()->id());
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

    /**
     * Return whether the groups's creator is authenticated
     *
     * @return bool
     */
    public function authIsMyTeacher(){
        return ($this->created_by == auth()->user()->id);
    }

    /**
     * Return created_at date in string format d. m. Y
     * @return string
     */
    public function createdAtToString() {
        return date('d. m. Y' , $this->created_at->getTimestamp());
    }
}
