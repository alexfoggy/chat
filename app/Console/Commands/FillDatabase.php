<?php

namespace App\Console\Commands;

use App\Models\Sites;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class FillDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill database with fake data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('migrate:fresh');


        factory(User::class, 10)->create();
//        factory(Sites::class, 100)->create();

        Artisan::call('db:seed');

    }
}
