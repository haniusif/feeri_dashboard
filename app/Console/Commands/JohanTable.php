<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JohanTable extends johan
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:table
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
    protected $description = 'Control single table';
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

        $askme = false;
        if ($this->option('d')) {
            $askme = true;
        }
        $conn = 'mysql';
        if ($this->option('conn')) {
            $conn = $this->option('conn');
        }
        $dbname = DB::connection($conn)->getDatabaseName();
        $this->info('Connection Name : ' . $conn . ' , Database Name : ' . $dbname);
        if ($this->option('dir') && in_array($this->option('dir'), ['rtl', 'ltr'])) {
            $dir      = $this->option('dir');
            $theamDir = in_array($dir, ['rtl', 'ltr']) ? $dir : 'ltr';
        } else {
            $theamDir = $this->choice(
                'Select dir',
                ['rtl', 'ltr'],
                1
            );
        }
        $hideAll = false;
        if ($this->option('hide')) {
            $hideAll = true;
        }
        $showMsgs = false;
        if ($this->option('msg')) {
            $showMsgs = true;
        }
        $translate = false;
        if ($this->option('translate')) {
            $translate = true;
        }
        $withModels = false;
        if ($this->option('models')) {
            $withModels = true;
            if ($showMsgs) {
                $this->info('with models option is selected');
            }
        }
        $showMsgs = false;
        if ($this->option('msg')) {
            $showMsgs = true;
        }
        $showTables = false;
        if ($this->option('tables')) {
            $showTables = true;
        }
        $useRow = false;
        if ($this->option('row')) {
            $useRow = true;
        }
        $withController = false;
        if ($this->option('controller')) {
            $withController = true;
        }
        $useDatatable = false;
        if ($this->option('datatable')) {
            $useDatatable = true;
        }
        $phrase = "/stubs/make/forms/vuexy/alerts.stub";
        $create = $this->create($phrase, $replace = [], $items = []);
        file_put_contents("resources/views/_partials/alerts.blade.php", $create);
        $headers            = ['LIST OF TABLEs', 'COUNT OF COLUMS'];
        $tables             = $this->tables($this->skipTables, $dbname, $conn);
        $table_list         = [];
        $table_list_to_show = [];
        foreach ($tables as $key => $table_value) {
            $tables_arr[]         = $key;
            $column_count         = count($table_value);
            $table_list[]         = $key;
            $table_list_to_show[] = [$key, $column_count];
        }
        if (! $hideAll) {
            $this->table($headers, $table_list_to_show);
        }
        if ($this->option('table') && in_array($this->option('table'), $table_list)) {
            $tableName = $this->option('table');
        } else {
            $tableName = $this->choice(
                'Select table',
                $table_list,
                null
            );
        }
        if ($this->option('del')) {
            // $apps_folder = app_path($this->app_name."/");
            // $Controllers_folder = app_path("Http/Controllers/".$this->app_name."/".$ucfirst_singular_model_name."Controller.php");
            $file_pointer = "resources/views/" . $this->app_name . "/" . $tableName . "/" . $tableName . ".blade.php";
            // $routes_folder = base_path('routes/web.php');
            // $reset =  $this->confirm("Reset $routes_folder ?");
            //   if($reset){
            //  $phrase = "/stubs/make/web.stub";
            //  $compileRoute = $this->compileRoute($phrase);
            //  file_put_contents(base_path('routes/web.php'),$compileRoute);
            //  if($showMsgs){
            //   $this->info("Rest done successfully");
            //  }
            //  }
            // $folders = [$Controllers_folder , $resources_folder , $apps_folder];
            //  $folders = [ $resources_folder ];
            //  foreach ($folders as $dir){
            //$confirmToDlete =  $this->confirm("Delete every things in $dir ?", 'yes');
            //if($confirmToDlete){
            //  $this->deletedir($dir , $showMsgs);
            // }
            //  }
// Use unlink() function to delete a file
            $this->unlink_file($file_pointer);
        }
        if ($this->option('theam') && in_array($this->option('theam'), $this->appTheams)) {
            $theam     = $this->option('theam');
            $theamName = in_array($theam, $this->appTheams) ? $theam : 'vuexy';
        } else {
            $theamName = $this->choice(
                'Select theam',
                $this->appTheams,
                1
            );
        }
        $this->info('selected table : ' . $tableName);
        $model_name                  = $tableName;
        $plural_model_name           = Str::plural($model_name);
        $singular_model_name         = Str::singular($model_name);
        $ucfirst_singular_model_name = ucfirst($singular_model_name);
        $ucfirst_plural_model_name   = ucfirst($plural_model_name);
        $title                       = Str::headline($ucfirst_plural_model_name);

        // $this->info("".$plural_model_name.":".$ucfirst_plural_model_name.":".$singular_model_name."".$ucfirst_singular_model_name);
        $viewsDir           = "resources/views/$this->app_name/$model_name";
        $searchDir          = $viewsDir . "/search";
        $Controllers_folder = "app/Http/Controllers/" . $this->app_name . "/";
        if ($withModels) {
            $exitCode = Artisan::call('make:model', ['name' => $this->app_name . '/' . $ucfirst_singular_model_name]);
        }
        $this->create_dir($viewsDir);
        $this->create_dir($searchDir);
        file_put_contents(
            base_path("$searchDir/search.blade.php"),
            "<!-- $model_name search form -->"
        );
        $this->create_dir($Controllers_folder);
        if ($withController) {
            // create controller header
            $phrase  = "/stubs/make/controllers/header.stub";
            $replace = ['{{name}}', '{{app_name}}'];
            $items   = [$ucfirst_singular_model_name, $this->app_name];
            $create  = $this->create($phrase, $replace, $items);
            file_put_contents($Controllers_folder . $ucfirst_singular_model_name . "Controller.php", $create);
        }
        // create web routes
        // $phrase = "/stubs/make/routes.stub";
        // $replace = ['{{name}}' , '{{names}}','{{app_name}}'] ;
        // $items = [$plural_model_name , $ucfirst_singular_model_name,$this->app_name] ;
        // $compileRoute = $this->compileRoute($phrase , $replace , $items)  ;
        // file_put_contents(base_path('routes/web.php'),$compileRoute,FILE_APPEND);
        // if($singular_model_name == 'user'){
        // $phrase = "/stubs/make/custom_routes.stub";
        // $replace = ['{{method}}', '{{path}}','{{controller}}','{{function}}'] ;
        // $items = ['get', 'my_profile',$this->app_name.'\User','my_profile'] ;
        // $compileRoute = $this->compileRoute($phrase , $replace , $items)  ;
        // file_put_contents(base_path('routes/web.php'),$compileRoute,FILE_APPEND);
        //  }
        // fill use array
        $columns = DB::connection($conn)->select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
                    FROM INFORMATION_SCHEMA.COLUMNS
                    WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$plural_model_name'");
        $constrints = DB::connection($conn)->select("select COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME
                    from information_schema.KEY_COLUMN_USAGE
                    where TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$plural_model_name'");
        $constrints_array         = [];
        $constrints_tables_name   = [];
        $constrints_tables_remote = [];
        $constrints_list_to_show  = [];
        $headers                  = ['TABLE_NAME', 'COLUMN_NAME', 'CONSTRAINT_NAME', 'REFERENCED_COLUMN_NAME', 'REFERENCED_TABLE_NAME'];
        $len                      = 30;
        foreach ($constrints as $constrint) {
            $COLUMN_NAME               = $constrint->COLUMN_NAME;
            $CONSTRAINT_NAME           = $constrint->CONSTRAINT_NAME;
            $REFERENCED_COLUMN_NAME    = $constrint->REFERENCED_COLUMN_NAME;
            $REFERENCED_TABLE_NAME     = $constrint->REFERENCED_TABLE_NAME;
            $constrints_list_to_show[] = [$this->tableStrlen($plural_model_name, $len), $this->tableStrlen($COLUMN_NAME, $len), $this->tableStrlen($CONSTRAINT_NAME, $len), $this->tableStrlen($REFERENCED_COLUMN_NAME, $len), $this->tableStrlen($REFERENCED_TABLE_NAME, $len)];
            if (! empty($REFERENCED_TABLE_NAME)) {
                $plural_REFERENCED_TABLE_NAME           = Str::plural($REFERENCED_TABLE_NAME);
                $singular_REFERENCED_TABLE_NAME         = Str::singular($REFERENCED_TABLE_NAME);
                $ucfirst_singular_REFERENCED_TABLE_NAME = ucfirst($singular_REFERENCED_TABLE_NAME);
                $ucfirst_plural_REFERENCED_TABLE_NAME   = ucfirst($plural_REFERENCED_TABLE_NAME);
                $constrints_tables_remote[$COLUMN_NAME] =
                    [
                    'REFERENCED_COLUMN_NAME' => $REFERENCED_COLUMN_NAME
                    , 'REFERENCED_TABLE_NAME' => $REFERENCED_TABLE_NAME,
                ];
                $constrints_tables_name[]                           = $singular_REFERENCED_TABLE_NAME;
                $constrints_array[$plural_model_name][$COLUMN_NAME] = [
                    'prtn'    => $plural_REFERENCED_TABLE_NAME,
                    'srtn'    => $singular_REFERENCED_TABLE_NAME,
                    'uc_prtn' => $ucfirst_plural_REFERENCED_TABLE_NAME,
                    'uc_srtn' => $ucfirst_singular_REFERENCED_TABLE_NAME];
                $ucfirst_table_plural   = ucfirst($REFERENCED_TABLE_NAME);
                $table_singular         = Str::singular($REFERENCED_TABLE_NAME);
                $ucfirst_table_singular = ucfirst($table_singular);
            }
        }
        if (! $hideAll && $showTables) {
            $this->table($headers, $constrints_list_to_show);
        }
        // views
        // views
        // index
        $stub_names = [$plural_model_name => ($useDatatable) ? 'index_header' : 'pure_index_header_with_search'];
        if ($singular_model_name == 'user') {
            $stub_names['my_profile'] = ($useDatatable) ? 'my_profile_header' : 'pure_my_profile_header';
        }
        $replace = ['{{name}}', '{{names}}', '{{uf_names}}', '{{APPNAME}}'];
        $items   = [$singular_model_name, $plural_model_name, $title, $this->app_name];
        $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
        $not_add       = [];
        $custom_column = [];
        // index
        if ($theamDir == 'ltr') {
            krsort($columns);
        }
        $colspan = 1;
        foreach ($columns as $column) {
            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE   = $column->DATA_TYPE;
            if ($askme) {
                $anser_add_choice = $this->choice(
                    'Add ' . $COLUMN_NAME . ' to index ?',
                    $this->add_choice,
                    0
                );
                $this->info('answer : ' . $anser_add_choice);
                if ($anser_add_choice == 'no') {
                    $not_add[] = $COLUMN_NAME;
                }
                if ($anser_add_choice == 'custom yes') {
                    $custom_column[] = $COLUMN_NAME;
                }
            }
            if (! in_array($COLUMN_NAME, $this->skipColumns) && ! in_array($COLUMN_NAME, $not_add)) {
                $stub_names = [
                    $plural_model_name => ($useDatatable) ? 'th_column' : 'pure_th_column',
                ];
                $replace = ['{{colum_name}}', '{{names}}'];
                $items   = [$COLUMN_NAME, $plural_model_name];
                $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                $colspan++;
            }
        }
        $stub_names = [
            //  $singular_model_name."_add" => 'create_header'
            // ,
            $plural_model_name => ($useDatatable) ? 'table' : 'pure_table',
            //  , $singular_model_name."_edit" => 'edit_header'
            //  , $singular_model_name."_view" => 'show_header'
        ];
        $replace = ['{{name}}', '{{names}}'];
        $items   = [$singular_model_name, $plural_model_name];
        $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
        if ($theamDir == 'ltr') {
            krsort($columns);
        }
        $colspan = 1;
        print_r($custom_column);
        foreach ($columns as $column) {
            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE   = $column->DATA_TYPE;
            if (! in_array($COLUMN_NAME, $this->skipColumns) && ! in_array($COLUMN_NAME, $not_add) && in_array($COLUMN_NAME, $custom_column)) {
                $stub_names = [
                    $plural_model_name => ($useDatatable) ? 'td_column' : 'pure_td_column',
                ];
                $new_colum_name = $this->ask("replace " . $COLUMN_NAME . " with ?");
                $new_colum_name = ($new_colum_name) ? $new_colum_name : $COLUMN_NAME;
                $replace        = ['{{name}}', '{{colum_name}}', '{{names}}'];
                $items          = [$singular_model_name, $new_colum_name, $plural_model_name];
                $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                $colspan++;
            } elseif (! in_array($COLUMN_NAME, $this->skipColumns) && ! in_array($COLUMN_NAME, $not_add) && ! in_array($COLUMN_NAME, $custom_column)) {
                $pure_td_column = $this->check_td_column($COLUMN_NAME);
                $stub_names     = [
                    $plural_model_name => ($useDatatable) ? 'td_column' : $pure_td_column,
                ];
                $replace = ['{{name}}', '{{colum_name}}', '{{names}}'];
                $items   = [$singular_model_name, $COLUMN_NAME, $plural_model_name];
                $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                $colspan++;
            }
        }
        $stub_names = [
            //  $singular_model_name."_add" => 'create_header'
            // ,
            $plural_model_name => ($useDatatable) ? 'index_endforeach' : 'pure_index_endforeach',
            //  , $singular_model_name."_edit" => 'edit_header'
            //  , $singular_model_name."_view" => 'show_header'
        ];
        $replace = ['{{name}}', '{{names}}', '{{colspan}}'];
        $items   = [$singular_model_name, $plural_model_name, $colspan];
        $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
        /// data for script
        foreach ($columns as $column) {
            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE   = $column->DATA_TYPE;
            if (! in_array($COLUMN_NAME, $this->skipColumns) && ! in_array($COLUMN_NAME, $not_add)) {
                $stub_names = [
                    $plural_model_name => ($useDatatable) ? 'script_data' : 'pure_script_data',
                ];
                $replace = ['{{colum_name}}'];
                $items   = [$COLUMN_NAME];
                $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
            }
        }
        $stub_names = [
            $plural_model_name => ($useDatatable) ? 'end_script' : 'pure_end_script',
        ];
        $replace = ['{{name}}', '{{names}}'];
        $items   = [$singular_model_name, $plural_model_name];
        $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
        $stub_names = [
            $plural_model_name => 'index_footer',
        ];
        if ($singular_model_name == 'user') {
            $stub_names['my_profile'] = 'my_profile_footer';
        }
        $replace = ['{{name}}', '{{names}}'];
        $items   = [$singular_model_name, $plural_model_name];
        $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
        // views
        if ($withController) {
            // add use models
            $constrints_tables_name_unique = array_unique($constrints_tables_name);
            foreach ($constrints_tables_name_unique as $constrints_table_name) {
                $constrints_table_name_singular         = Str::singular($constrints_table_name);
                $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                    $stub_name = ["apps"];
                    $replace   = ['{{name}}', '{{app_name}}'];
                    $items     = [$ucfirst_constrints_table_name_singular, $this->app_name];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
            }
            $indexStub = ($useDatatable) ? 'index' : 'pure_index';
            // controller class name & index function
            $stub_name = ["class_name", $indexStub];
            $replace   = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items     = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // controller data table all data function
            $constrints_tables_name_unique = array_unique($constrints_tables_name);
            // create
            $stub_name = ["all_data"];
            $replace   = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items     = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_remote as $key => $value) {
                // REFERENCED_COLUMN_NAME
                // REFERENCED_TABLE_NAME
                if (! in_array($key, ['created_by', 'updated_by'])) {
                    $REFERENCED_COLUMN_NAME = $value['REFERENCED_COLUMN_NAME'];
                    $REFERENCED_TABLE_NAME  = $value['REFERENCED_TABLE_NAME'];
                    $stub_name              = ["all_data_select"];
                    $replace                = ['{{names}}', '{{name}}', '{{col_name}}', '{{main_colum_name}}'];
                    $items                  = [$REFERENCED_TABLE_NAME, Str::singular($REFERENCED_TABLE_NAME), $REFERENCED_COLUMN_NAME, $this->main_colum_name($REFERENCED_TABLE_NAME, $conn)];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
            }
            // create
            $stub_name = ["all_data_select_end"];
            $replace   = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items     = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_remote as $key => $value) {
                // REFERENCED_COLUMN_NAME
                // REFERENCED_TABLE_NAME
                if (! in_array($key, ['created_by', 'updated_by'])) {
                    $REFERENCED_COLUMN_NAME = $value['REFERENCED_COLUMN_NAME'];
                    $REFERENCED_TABLE_NAME  = $value['REFERENCED_TABLE_NAME'];
                    $stub_name              = ["all_data_leftjoin"];
                    $replace                = ['{{names}}', '{{name}}', '{{col_name}}', '{{tbl_name}}', '{{tbl_col_name}}'];
                    //$prtn    = Str::plural($value);
                    //$uc_srtn = ucfirst($value);
                    $items = [$REFERENCED_TABLE_NAME, Str::singular($REFERENCED_TABLE_NAME), $REFERENCED_COLUMN_NAME, $plural_model_name, $key];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
            }
            // create
            $stub_name = ["all_data_end"];
            $replace   = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items     = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            // controller create function
            $stub_name = ["create"];
            $replace   = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items     = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_name_unique as $value) {
                $stub_name = ["create_models"];
                $replace   = ['{{names}}', '{{name}}'];
                $prtn      = Str::plural($value);
                $uc_srtn   = ucfirst($value);
                $items     = [$prtn, $uc_srtn];
                $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            }
            // create
            $stub_name = ["create_return"];
            $replace   = ['{{names}}', '{{name}}'];
            $items     = [$plural_model_name, $singular_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_name_unique as $value) {
                $stub_name = ["create_with"];
                $replace   = ['{{names}}'];
                $prtn      = Str::plural($value);
                $items     = [$prtn];
                $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            }
            // create
            $stub_name = ["store"];
            $replace   = [];
            $items     = [];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            if ($theamDir == 'ltr') {
                krsort($columns);
            }
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE   = $column->DATA_TYPE;
                if (! in_array($COLUMN_NAME, $this->columnSkeps)) {
                    if (! in_array($COLUMN_NAME, $this->skipId) && ! in_array($COLUMN_NAME, $this->booleanValues)) {
                        // create
                        $stub_name = ["validate_input"];
                        $replace   = ['{{input}}'];
                        $items     = [$COLUMN_NAME];
                        $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                        // create
                    }
                }
            }
            // create
            $stub_name = ["validate_end_tag"];
            $replace   = ['{{name}}', '{{UC_name}}'];
            $items     = [$singular_model_name, $ucfirst_singular_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE   = $column->DATA_TYPE;
                if (in_array($COLUMN_NAME, $this->authColumns)) {
                    $stub_name = ["input_auth"];
                    $replace   = ['{{name}}', '{{input}}'];
                    $items     = [$singular_model_name, $COLUMN_NAME];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
                if (! in_array($COLUMN_NAME, $this->skipId) && ! in_array($COLUMN_NAME, $this->skipColumns)) {
                    // create
                    $stub_name = ["input"];
                    $replace   = ['{{name}}', '{{input}}'];
                    $items     = [$singular_model_name, $COLUMN_NAME];
                    if (in_array($COLUMN_NAME, $this->files)) {
                        $stub_name = ["input_file"];
                        $replace   = ['{{names}}', '{{name}}', '{{input}}'];
                        $items     = [$plural_model_name, $singular_model_name, $COLUMN_NAME];
                    } elseif (in_array($COLUMN_NAME, $this->booleanValues)) {
                        $stub_name = ["input_boolean"];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_model_name, $COLUMN_NAME];
                    } elseif ($COLUMN_NAME == "password") {
                        $stub_name = ["input_password"];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_model_name, $COLUMN_NAME];
                    }
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                    // create
                }
            }
            // show
            // create
            $stub_name = ["craete_end"];
            $replace   = ['{{class_name}}', '{{name}}', '{{names}}'];
            $items     = [$ucfirst_singular_model_name, $singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            // create
            $stub_name = ["show"];
            $replace   = ['{{names}}', '{{name}}', '{{UC_name}}'];
            $items     = [$plural_model_name, $singular_model_name, ucfirst($singular_model_name)];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_name_unique as $constrints_table_name) {
                $constrints_table_name_singular         = Str::singular($constrints_table_name);
                $constrints_table_name_plural           = Str::plural($constrints_table_name);
                $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                // create
                if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                    $stub_name = ["show_models"];
                    $replace   = ['{{name}}', '{{names}}'];
                    $items     = [$ucfirst_constrints_table_name_singular, $constrints_table_name_plural];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                    // create
                }
            }
            // create
            $stub_name = ["show_return"];
            $replace   = ['{{names}}', '{{name}}'];
            $items     = [$plural_model_name, $singular_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_name_unique as $value) {
                $constrints_table_name_singular         = Str::singular($value);
                $constrints_table_name_plural           = Str::plural($value);
                $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                // create
                if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                    $stub_name = ["show_with"];
                    $replace   = ['{{names}}'];
                    $items     = [$constrints_table_name_plural];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
            }
            // show
            // myprofile
            if ($singular_model_name == 'user') {
                $stub_name = ["my_profile"];
                $replace   = ['{{name}}', '{{UC_name}}'];
                $items     = [$singular_model_name, ucfirst($singular_model_name)];
                $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                // create
                foreach ($constrints_tables_name_unique as $constrints_table_name) {
                    $constrints_table_name_singular         = Str::singular($constrints_table_name);
                    $constrints_table_name_plural           = Str::plural($constrints_table_name);
                    $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                    // create
                    if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                        $stub_name = ["show_models"];
                        $replace   = ['{{name}}', '{{names}}'];
                        $items     = [$ucfirst_constrints_table_name_singular, $constrints_table_name_plural];
                        $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                        // create
                    }
                }
                // create
                $stub_name = ["my_profile_return"];
                $replace   = ['{{names}}', '{{name}}'];
                $items     = [$plural_model_name, $singular_model_name];
                $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                // create
                foreach ($constrints_tables_name_unique as $value) {
                    $constrints_table_name_singular         = Str::singular($value);
                    $constrints_table_name_plural           = Str::plural($value);
                    $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                    // create
                    if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                        $stub_name = ["show_with"];
                        $replace   = ['{{names}}'];
                        $items     = [$constrints_table_name_plural];
                        $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                    }
                }
                // show
            }
            // myprofile
            // create
            $stub_name = ["edit", "update"];
            $replace   = ['{{name}}', '{{names}}', '{{UC_name}}'];
            $items     = [$singular_model_name, $plural_model_name, $ucfirst_singular_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE   = $column->DATA_TYPE;
                if ($COLUMN_NAME == "updated_by") {
                    $stub_name = ["input_auth"];
                    $replace   = ['{{name}}', '{{input}}'];
                    $items     = [$singular_model_name, $COLUMN_NAME];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
                if (! in_array($COLUMN_NAME, $this->skipId) && ! in_array($COLUMN_NAME, $this->skipColumns)) {
                    // create
                    $stub_name = ["input"];
                    $replace   = ['{{name}}', '{{input}}'];
                    $items     = [$singular_model_name, $COLUMN_NAME];
                    if (in_array($COLUMN_NAME, $this->files)) {
                        $stub_name = ["input_file"];
                        $replace   = ['{{names}}', '{{name}}', '{{input}}'];
                        $items     = [$plural_model_name, $singular_model_name, $COLUMN_NAME];
                    } elseif (in_array($COLUMN_NAME, $this->booleanValues)) {
                        $stub_name = ["input_boolean"];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_model_name, $COLUMN_NAME];
                    } elseif ($COLUMN_NAME == "password") {
                        $stub_name = ["input_password"];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_model_name, $COLUMN_NAME];
                    }
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                    // create
                }
            }
            // create
            $stub_name = ["footer"];
            $replace   = ['{{name}}', '{{UC_name}}'];
            $items     = [$singular_model_name, $ucfirst_singular_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
        }
    }
}
