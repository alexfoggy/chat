<?php

use Illuminate\Database\Seeder;

class TaskLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Task::limit(100)->get() as $task) {
            \Illuminate\Support\Facades\DB::table('languageables')->insert([
                'language_id' => 37,
                'languageable_type' => \App\Models\Task::class,
                'languageable_id' => $task->id
            ]);
        }

    }
}
