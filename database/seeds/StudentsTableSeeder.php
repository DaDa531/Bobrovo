<?php

use App\Student;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$student = new Student([
            'first_name' => 'Janko',
            'last_name' => 'Hraško',
            'code' => 'abcdefghij',
            'teacher_id' => 1
        ]);
        $student->save();*/

        $teacherIDs = User::getIDs();
        $faker = Faker::Create();
        for ($i = 0; $i < 20; $i++) {
            $student = new Student([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'code' => $faker->bothify('**********'),
                'teacher_id' => $teacherIDs->random()
            ]);

            $student->save();
        }
    }
}
