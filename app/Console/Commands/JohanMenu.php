<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JohanMenu extends johan
{
    public $tables = 0;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:menu
        {--models : Create views with models}
        {--del : Delete all views, controllers, and routes for selected table}
        {--table=all : Target table (default: all)}
        {--msg : Show messages}
        {--auth_route=true : with auth meddleware}
        {--controller : Include controllers}
        {--hide : Hide tables and translate result}
        {--conn=mysql : Database connection name (default: mysql)}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate or delete routes for web and API';
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
        $verticalMenu = resource_path('menu/verticalMenu.json');
        $delAll       = false;
        if ($this->option('del')) {
            $delAll = true;
        }
        $auth_route = false;
        if ($this->option('auth_route')) {
            $auth_route = true;
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
        $showMsgs = false;
        if ($this->option('msg')) {
            $showMsgs = true;
        }
        if ($this->option('del')) {
            if (! file_exists(dirname($verticalMenu))) {
                mkdir(dirname($verticalMenu), 0755, true);
            }
            file_put_contents($verticalMenu, '');
            if ($showMsgs) {
                $this->info("Rest done successfully");
            }
        }
        $table_list         = [];
        $table_list_to_show = [];
        $headers            = ['LIST OF TABLEs', 'COUNT OF COLUMS'];
        $tables             = $this->tables($this->skipTables, $dbname, $conn);
        foreach ($tables as $key => $table_value) {
            $column_count         = count($table_value);
            $table_list[]         = $key;
            $table_list_to_show[] = [$key, $column_count];
        }
        if (! $hideAll) {
            $this->table($headers, $table_list_to_show);
        }
        $stub_file = "/stubs/Menu/verticalMenu_start.stub";
        $this->append_to($stub_file, $verticalMenu);
        print_r(Artisan::output());

        $lastTableKey = array_key_last($tables);

        foreach ($tables as $table_name => $table_value) {
            $plural_model_name           = Str::plural($table_name);
            $singular_model_name         = Str::singular($table_name);
            $ucfirst_singular_model_name = ucfirst($singular_model_name);
            $ucfirst_plural_model_name   = ucfirst($plural_model_name);
            $title                       = Str::headline($ucfirst_plural_model_name);

            $stub_file = "/stubs/Menu/verticalMenu_node.stub";
            if ($lastTableKey == $plural_model_name) {
                $stub_file = "/stubs/Menu/verticalMenu_last_node.stub";
            }
            $replace = ['{{name}}', '{{names}}', '{{menu_names}}'];
            $items   = [$plural_model_name, $plural_model_name, $title];
            $this->append_to($stub_file, $verticalMenu, $replace, $items);
        }
        $stub_file = "/stubs/Menu/verticalMenu_end.stub";
        $this->append_to($stub_file, $verticalMenu, []);
        $this->info('End');
    }
}
