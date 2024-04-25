<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Task::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // $total = 1000000;
        // $batchSize = 1000;

        // for ($i = 0; $i < $total; $i += $batchSize) {
        //     $tasks = Task::factory($batchSize)->make();
        //     Task::insert($tasks->toArray());
        // }

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
