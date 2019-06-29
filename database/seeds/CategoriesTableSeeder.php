<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(array(
            array("name" => "Drobci", "class" =>  "ZŠ 2-3"),
            array("name" => "Bobríci", "class" => "ZŠ 4-5"),
            array("name" => "Benjamíni", "class" => "ZŠ 6-7"),
            array("name" => "Kadeti", "class" => "ZŠ 8-9"),
            array("name" => "Juniori", "class" => "Gym. a SŠ 1-2"),
            array("name" => "Seniori", "class" => "Gym. a SŠ 3-4"),
            array("name" => "Nevidiaci ZŠ", "class" => "ZŠ 2. stupeň"),
            array("name" => "Nevidiaci SŠ", "class" => "SŠ"),
        ));
    }
}
