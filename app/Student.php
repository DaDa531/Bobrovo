<?php

namespace App;

use App\Group;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    /**
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'code', 'teacher_id'];

    /**
     * Return student's teacher (author)
     *
     * @return BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    /**
     * Return students's groups
     *
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'student_group');
    }


    /**
     * Return studentswith given code
     *
     * @return Builder|Model
     */
    public static function getStudent($code)
    {
        return static::query()->where('code', $code)->first();
    }


    /**
     * Return current teacher's students
     *
     * @return Builder|Model
     */
    public static function getStudents()
    {
        return static::query()->where('teacher_id', auth()->id());
    }


    /**
     * Return if student can be deleted (user is his/her teacher and no test is assigned to him/her)
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
     * Generates a unique code for a student
     * @return string
     */
    public static function generateCode()
    {
        $code = '';
        $faker = Faker::create();
        while(true){
            $code = $faker->bothify('**********');
            $student = Student::getStudent($code);
            if ($student == null){
                break;
            }
        }
        return $code;
    }

    /**
     * Return whether the student's teacher is authenticated
     * @return bool
     */
    public function authIsMyTeacher(){
        return ($this->teacher_id == auth()->user()->id);
    }

    /**
     * Return created_at date in string format d. m. Y
     * @return string
     */
    public function createdAtToString() {
        return date('d. m. Y' , $this->created_at->getTimestamp());
    }
}
