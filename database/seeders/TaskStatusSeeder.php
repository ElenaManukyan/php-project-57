<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['новый', 'в работе', 'на тестировании', 'завершен'];

        foreach ($statuses as $status) {
            \App\Models\TaskStatus::updateOrCreate(['name' => $status]);
        }
    }
}