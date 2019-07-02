<?php

use App\User;
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
            //toto nefunguje, pre ucitela(usera) to nechce dat grupy, hlada BelongsTo, ale to je HasMany
            //$groups = $student->teacher()->groups()->pluck('id');
            //$student->groups()->attach($faker->randomElements($groups, random_int(1,$groups->count())));

            $student->groups()->attach($faker->randomElements([1,2,3,4,5], random_int(1,3)));

        }
    }
}
