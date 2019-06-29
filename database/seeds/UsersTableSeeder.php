<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'email' => 'dan.bezakova@gmail.com',
            'first_name' => 'DaDa',
            'last_name' => 'Bezáková',
            'password' => bcrypt('secret'),
            'is_admin' => true,
        ]);
        $user->save();

        $user = new User([
            'email' => 'testmail@gmail.com',
            'first_name' => 'Tester',
            'last_name' => 'Univerzálny',
            'password' => bcrypt('secret'),
            'is_admin' => false,
        ]);
        $user->save();

        $faker = Faker::create();
        for($i = 0; $i < 3; $i++){
            $user = new User([
                'email' => $faker->email,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'password' => bcrypt('secret'),
                'is_admin' => false,
            ]);

            $user->save();
        }
    }
}
