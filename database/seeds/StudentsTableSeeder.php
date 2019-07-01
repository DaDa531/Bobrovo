<?php

use App\Student;
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
        //opravit teacher_id - zistit vsetky id-cka ucitelov a z nich vyberat nahodne

        /*$student = new Student([
            'first_name' => 'Janko',
            'last_name' => 'Hraško',
            'code' => 'abcdefghij',
            'teacher_id' => 1
        ]);
        $student->save();*/

        $faker = Faker::Create();
        for ($i = 0; $i < 20; $i++) {
            $student = new Student([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'code' => $faker->bothify('**********'),
                'teacher_id' => $faker->numberBetween(1,5)
            ]);

            $student->save();
        }
    }
}
