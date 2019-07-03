<?php

use App\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $categoriesCount = DB::table('categories')->count();

        //najskôr každej úlohe priradím aspoň jednu kategóriu

        foreach ($tasks as $task)
            $task->categories()->attach(random_int(1, $categoriesCount));


        //potom náhodným úlohám priradím ďalšiu kategóriu

        $max = random_int(5, $tasks->count());
        for ($i = 0; $i < $max; $i++) {
            $task = $tasks->random();
            try {
                $task->categories()->attach(random_int(1, $categoriesCount));
            } catch (Exception $exception) {
                //
            }
        }
    }
}
