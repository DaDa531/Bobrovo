<?php

namespace App;

use App\Group;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelonsTo;
use Illuminate\Database\Eloquent\Relations\BelonsToMany;

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
    public static function getStudentWithCode($code)
    {
        return static::query()->where('code', $code)->first();
    }


    /**
     * Return current teacher's students
     *
     * @return Builder|Model
     */
    public static function getStudentsFromCurrentTeacher()
    {
        return static::query()->where('teacher_id', auth()->user()->id);
    }


    /**
     * Return if student can be deleted (no test assigned)
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
            $student = Student::getStudentWithCode($code);
            if ($student == null){
                break;
            }
        }
        return $code;
    }
}
