<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $NUM_FAKER = 10;
        DB::table('tasks')->insert([
            'user_id' => 1,
            'title' => 'ページネーション用タスク',
            'description' => 'ページネーション用タスクの詳細です。',
            'due_date' => '20260131',
            'status' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
