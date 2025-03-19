<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class JohanDashboard extends johan
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:dashboard
    {--models : create views with models }
    {--counters : create views with models }
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'bulid dashboard';

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

        $resources_folder = "resources/views/";

        $phrase = "/stubs/make/dashboard/dashboard.stub";

        $compileRoute = $this->compileRoute($phrase);

        file_put_contents(base_path($resources_folder . '/dashboard.blade.php'), $compileRoute);

    }
}
