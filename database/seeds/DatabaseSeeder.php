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
        // $this->call(UserSeeder::class);
//        $this->call(TaskUserSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(CountriesSeeder::class);
//        $this->call(TaskLanguageSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(UserUserTypeSeeder::class);
    }
}
