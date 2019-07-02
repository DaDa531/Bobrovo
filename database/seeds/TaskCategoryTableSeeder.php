<?php

use App\Task;
use App\Category;
use Illuminate\Database\Seeder;

class TaskCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = Task::all();
        $categoryIDs = Category::getIDs();

        //najskôr každej úlohe priradím aspoň jednu kategóriu

        foreach ($tasks as $task)
            $task->categories()->attach($categoryIDs->random());


        //potom náhodným úlohám priradím ďalšiu kategóriu

        $max = random_int(5,$tasks->count());
        for ($i = 0; $i < $max; $i++) {
            $task = $tasks->random();
            try {
                $task->categories()->attach($categoryIDs->random());
            } catch (Exception $exception) {
                //
            }
        }
    }
}
