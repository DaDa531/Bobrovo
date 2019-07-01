<?php

use App\Group;
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
        //opravit created_by - zistit vsetky id-cka ucitelov a z nich vyberat nahodne
        $faker = Faker::create();
        for($i = 0; $i < 10; $i++){
            $group = new Group([
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'created_by' => $faker->numberBetween(1,5)
            ]);

            $group->save();
        }
    }
}
