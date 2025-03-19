<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class JohanCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call All';

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
        // Artisan::call('db:migrate', ['' => 'mymigration', '--table' => 'mytable']) should work.
        // php artisan johan:create --del --controller --table=shop_categories --hide --d --dir=rtl
        Artisan::call('johan:table',
            //  [
            //     '--del' => '--del' ,
            //     '--controller' => '--controller' ,
            //     '--table' => 'cities' ,
            //     '--hide' => '--hide' ,
            //     '--d' => '--d' ,
            //     '--dir' => 'rtl'
            //  ]
        );

        echo (Artisan::output());

    }
}
