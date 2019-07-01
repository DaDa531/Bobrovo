<?php

use App\Group;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacherIDs = User::getIDs();
        $faker = Faker::create();
        for($i = 0; $i < 10; $i++){
            $group = new Group([
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'created_by' => $teacherIDs->random()
            ]);

            $group->save();
        }
    }
}
