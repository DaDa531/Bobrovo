<?php

use App\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = DB::table('users')->count();
        $faker = Faker::Create();

        for ($i = 0; $i < 50; $i++) {
            $student = new Student([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'code' => $faker->bothify('**********'),
                'teacher_id' => $faker->numberBetween(1, $usersCount)
            ]);

            $student->save();
        }
    }
}
