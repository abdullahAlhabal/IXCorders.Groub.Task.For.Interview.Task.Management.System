<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        User::factory(10)->create();

        Task::truncate();

        // $total = 1000000;    // one million
        $total = 1001;
        $batchSize = 1000;

        for ($i = 0; $i <= $total; $i += $batchSize) {
            $tasks = Task::factory($batchSize)->make();
            Task::insert($tasks->toArray());
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
