<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            TopicsTableSeeder::class,
            CategoriesTableSeeder::class,
            GroupsTableSeeder::class,
            StudentsTableSeeder::class,
			TasksTableSeeder::class,
            TaskTopicTableSeeder::class,
            TaskCategoryTableSeeder::class,
            RatingsTableSeeder::class,
            CommentsTableSeeder::class,
            StudentGroupTableSeeder::class,
            TestsTableSeeder::class
        ]);
    }
}