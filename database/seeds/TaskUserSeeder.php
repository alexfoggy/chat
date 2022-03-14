<?php

use Illuminate\Database\Seeder;

class TaskUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(\App\Models\Sites::whereStatus(true)->get()->count()) {
            foreach (\App\Models\Sites::limit(40)->get() as $task) {
                \Illuminate\Support\Facades\DB::table('taskables')->insert([
                    'task_uuid' => $task->uuid,
                    'taskable_type' => \App\User::class,
                    'taskable_id' => \App\User::first()->id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
