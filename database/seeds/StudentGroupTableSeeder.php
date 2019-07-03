<?php

use App\Group;
use App\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class StudentGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();
        $faker = Faker::create();

        foreach ($students as $student) {
            $groups = Group::where('created_by', $student->teacher_id)->pluck('id');
            if ($groups->isNotEmpty()) {
                $groups = $faker->randomElements($groups, random_int(1,$groups->count()));
                $student->groups()->attach($groups);
            }
        }
    }
}
