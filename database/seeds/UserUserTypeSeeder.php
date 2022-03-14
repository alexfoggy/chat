<?php

use Illuminate\Database\Seeder;

class UserUserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::limit(3)->get();
        foreach ($users as $user) {
            $user->type()->attach([$user->id]);
        }
    }
}
