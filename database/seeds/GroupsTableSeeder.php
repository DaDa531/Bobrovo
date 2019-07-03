<?php

use App\Group;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = DB::table('users')->count();
        $faker = Faker::create();
        for($i = 0; $i < 20; $i++){
            $group = new Group([
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'created_by' => $faker->numberBetween(1, $usersCount)
            ]);

            $group->save();
        }
    }
}
