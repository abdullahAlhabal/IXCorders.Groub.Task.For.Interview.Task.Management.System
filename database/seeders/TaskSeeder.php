<?php

namespace Database\Seeders;

use App\Models\Task;
use Database\Factories\TaskFactory;
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
        // Re-enable foreign key constraints
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
