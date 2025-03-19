<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JohanRoute extends johan
{
    public $tables = 0;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:route
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
        $delAll = false;
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
            $routes_folder = base_path('routes/web.php');
            $phrase = "/stubs/Routes/web.stub";
            $compileRoute = $this->compileRoute($phrase);
            file_put_contents(base_path('routes/web.php'), $compileRoute);
            if ($showMsgs) {
                $this->info("Rest done successfully");
            }
        }
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
        $webRoutesPath = base_path('routes/web.php');
        $phrase = "/stubs/Routes/route_use.stub";
        $replace = ['{{name}}', '{{names}}', '{{app_name}}'];
        print_r(Artisan::output());
        foreach ($tables as $table_name => $table_value) {
            $plural_model_name = Str::plural($table_name);
            $singular_model_name = Str::singular($table_name);
            $ucfirst_singular_model_name = ucfirst($singular_model_name);
            $ucfirst_plural_model_name = ucfirst($plural_model_name);
            $items = [$plural_model_name, $ucfirst_singular_model_name, $this->app_name];
            $compileRoute = $this->compileRoute($phrase, $replace, $items);
            $currentRoutes = file_get_contents($webRoutesPath);
            if (strpos($currentRoutes, $compileRoute) === false) {
                file_put_contents($webRoutesPath, $compileRoute, FILE_APPEND);
                $this->info("Route added for table {$plural_model_name}");
            } else {
                $this->info("Route {$plural_model_name} already exists. Skipping...");
            }
        }
        $stub_file = "/stubs/Routes/route_home_controller_use.stub";
        $this->append_to($stub_file, $webRoutesPath);
        $stub_file = "/stubs/Routes/route_auth_start.stub";
        $this->append_to($stub_file, $webRoutesPath);
        $stub_file = "/stubs/Routes/route_home_controller.stub";
        $this->append_to($stub_file, $webRoutesPath);
        foreach ($tables as $table_name => $table_value) {
            $plural_model_name = Str::plural($table_name);
            $singular_model_name = Str::singular($table_name);
            $ucfirst_singular_model_name = ucfirst($singular_model_name);
            $phrase = "/stubs/Routes/routes.stub";
            $replace = ['{{name}}', '{{names}}', '{{app_name}}'];
            $items = [$plural_model_name, $ucfirst_singular_model_name, $this->app_name];
            $compileRoute = $this->compileRoute($phrase, $replace, $items);
            $currentRoutes = file_get_contents($webRoutesPath);
            if (strpos($currentRoutes, $compileRoute) === false) {
                file_put_contents($webRoutesPath, $compileRoute, FILE_APPEND);
                $this->info("Route added for table '{$plural_model_name}'");
            } else {
                $this->info("Route '{$plural_model_name}' already exists. Skipping...");
            }
        }
        $stub_file = "/stubs/Routes/route_auth_end.stub";
        $this->append_to($stub_file, $webRoutesPath);
        $controller = 'App\Http\Controllers\HomeController';
        if (!class_exists($controller)) {
            $this->error("'{$controller}' does not exist.");
            Artisan::call('make:controller HomeController');
            $this->info("'{$controller}' created");
        }
        $this->info('End');
    }
}
