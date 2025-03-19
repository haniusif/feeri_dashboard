<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class JohanMagic extends johan
{
    public $tables = 0;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:magic
    {--models : create views with models }
    {--theam=vuexy : sellect theams }
    {--del :  delete all views ,controllers and routes for selected table }
    {--table=all :  table name }
    {--msg :  show msgs  }
    {--controller :  with controller or not  }
    {--hide : hide tables and translate result}
    {--d :  create views  with details }
    {--translate :  translate table to arabic using google translator }
    {--tables :  show all tables details  }
    {--row :  use row insted off datatable  }
    {--datatable :  use datatable }
    {--dir=ltr :  select dir }
    {--conn=mysql :  duflt connection name  }
    ';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refactor tables view';
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
        $delAll = false;
        if ($this->option('del')) {
            $delAll = true;
        }
        $hideAll = false;
        if ($this->option('hide')) {
            $hideAll = true;
        }
        $conn = config('database.default');
        if ($this->option('conn')) {
            $conn = $this->option('conn');
        }
        $dbname = DB::connection($conn)->getDatabaseName();
        $this->info('Connection Name : ' . $conn . ' , Database Name : ' . $dbname);
        $table_list = [];
        $table_list_to_show = [];
        $headers = ['LIST OF TABLEs', 'COUNT OF COLUMS'];
        $tables = $this->tables($this->skipTables, $dbname, $conn);
        foreach ($tables as $key => $table_value) {
            $column_count = count($table_value);
            $table_list[] = $key;
            $table_list_to_show[] = [$key, $column_count];
        }
        if (!$hideAll) {
            $this->table($headers, $table_list_to_show);
        }

        $exitCode = Artisan::call('johan:menu', ['--del' => '--del']);
        print_r(Artisan::output());

        $exitCode = Artisan::call('johan:route', ['--del' => '--del']);
        print_r(Artisan::output());

        $exitCode = Artisan::call('johan:views', ['--del' => '--del'
            , '--models' => '--models',
        ]);
        print_r(Artisan::output());

        foreach ($tables as $key => $table_value) {
// php artisan johan:table --del --table=Addresses --controller  --dir=ltr --conn=runx
            $exitCode = Artisan::call('johan:table', [
                '--del' => '--del'
                , '--table' => "$key"
                , '--conn' => $conn
                , '--controller' => '--controller'
                //    , '--hide' => $hideAll
                , '--dir' => 'rtl',
            ]);
            print_r(Artisan::output());
        }
        foreach ($tables as $key => $table_value) {
// php artisan johan:search --del --table=users --function  --conn=mysql --tables --controller
            $exitCode = Artisan::call('johan:search', [
                '--del' => '--del'
                , '--table' => "$key"
                , '--function' => '--function'
                , '--tables' => '--tables'
                , '--controller' => '--controller'
                , '--conn' => $conn
                //    , '--hide' => $hideAll
                , '--dir' => 'rtl',
            ]);
            print_r(Artisan::output());
        }
        $this->info('end');
    }
}
