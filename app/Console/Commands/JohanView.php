<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JohanView extends johan
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:views
    {--theam=vuexy : sellect theams }
    {--models : create views with models }
    {--hide : hide tables and translate result while creating modules}
    {--ckeditor :  use ckeditor with text and longtext  }
    {--del :  delete all views ,controllers and routes }
    {--tables :  show all tables details  }
    {--msg :  show msgs  }
    {--d :  create views  with details }
    {--conn=mysql :  duflt connection name  }
    ';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Views';
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
        $hideAll = false;
        if ($this->option('hide')) {
            $hideAll = true;
        }
        $showTables = false;
        if ($this->option('tables')) {
            $showTables = true;
        }
        $showMsgs = false;
        if ($this->option('msg')) {
            $showMsgs = true;
        }
        $viewWithDetails = false;
        if ($this->option('d')) {
            $viewWithDetails = true;
        }
        $withModels = false;
        if ($this->option('del')) {
            $apps_folder = app_path($this->app_name . "/");
            $Controllers_folder = app_path("Http/Controllers/" . $this->app_name . "/");
            $resources_folder = "resources/views/" . $this->app_name . "/";

            $folders = [$Controllers_folder, $resources_folder, $apps_folder];
            foreach ($folders as $dir) {
                //$confirmToDlete =  $this->confirm("Delete every things in $dir ?", 'yes');
                //if($confirmToDlete){
                $this->deletedir($dir, $showMsgs);
                // }
            }
        }
        if ($this->option('models')) {
            $withModels = true;
            if ($showMsgs) {
                $this->info('with models option is selected');
            }
        } else {
            if ($this->confirm('with models ?', 'yes')) {
                $withModels = true;
                if ($showMsgs) {
                    $this->info('with models option is selected');
                }
            } else {
                if ($showMsgs) {
                    $this->info('no models');
                }
            }
        }
        if ($this->option('theam') && in_array($this->option('theam'), $this->appTheams)) {
            $theam = $this->option('theam');
            $theamName = in_array($theam, $this->appTheams) ? $theam : 'vuexy';
        } else {
            $theamName = $this->choice(
                'Select theam',
                $this->appTheams,
                1
            );
        }
        if ($showMsgs) {
            $this->info($theamName . ' theam is selected');
        }
        $conn = 'mysql';
        if ($this->option('conn')) {
            $conn = $this->option('conn');
        }
        $dbname = DB::connection($conn)->getDatabaseName();
        $this->info('Connection Name : ' . $conn . ' , Database Name : ' . $dbname);
        $headers = ['LIST OF TABLEs', 'COUNT OF COLUMS'];
        $tables = $this->tables($this->skipTables, $dbname, $conn);
        foreach ($tables as $key => $table_value) {
            $column_count = count($table_value);
            $table_list[] = $key;
            $table_list_to_show[] = [$key, $column_count];
        }
        if (!$hideAll && $showTables) {
            $this->table($headers, $table_list_to_show);
        }

        foreach ($table_list as $model_name) {
            $plural_model_name = Str::plural($model_name);
            $singular_model_name = Str::singular($model_name);
            $ucfirst_singular_model_name = ucfirst($singular_model_name);
            $ucfirst_plural_model_name = ucfirst($plural_model_name);
            // $this->info("".$plural_model_name.":".$ucfirst_plural_model_name.":".$singular_model_name."".$ucfirst_singular_model_name);
            $viewsDir = "resources/views/$this->app_name/$model_name";
            $Controllers_folder = "app/Http/Controllers/" . $this->app_name . "/";
            if ($withModels) {
                $exitCode = Artisan::call('make:model', ['name' => $this->app_name . '/' . $ucfirst_singular_model_name]);
            }
            $this->create_dir($viewsDir);
            $this->create_dir($Controllers_folder);
            // create controller header
            $phrase = "/stubs/make/controllers/header.stub";
            $replace = ['{{name}}', '{{app_name}}'];
            $items = [$ucfirst_singular_model_name, $this->app_name];
            $create = $this->create($phrase, $replace, $items);
            file_put_contents($Controllers_folder . $ucfirst_singular_model_name . "Controller.php", $create);

            // fill use array
            $columns = DB::connection($conn)->select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$plural_model_name'");
            $constrints = DB::connection($conn)->select("select COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME
            from information_schema.KEY_COLUMN_USAGE
            where TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$plural_model_name'");
            $constrints_array = [];
            $constrints_tables_name = [];
            $constrints_tables_remote = [];
            $constrints_list_to_show = [];
            $headers = ['TABLE_NAME', 'COLUMN_NAME', 'CONSTRAINT_NAME', 'REFERENCED_COLUMN_NAME', 'REFERENCED_TABLE_NAME'];
            $len = 30;
            foreach ($constrints as $constrint) {
                $COLUMN_NAME = $constrint->COLUMN_NAME;
                $CONSTRAINT_NAME = $constrint->CONSTRAINT_NAME;
                $REFERENCED_COLUMN_NAME = $constrint->REFERENCED_COLUMN_NAME;
                $REFERENCED_TABLE_NAME = $constrint->REFERENCED_TABLE_NAME;
                $constrints_list_to_show[] = [$this->tableStrlen($plural_model_name, $len), $this->tableStrlen($COLUMN_NAME, $len), $this->tableStrlen($CONSTRAINT_NAME, $len), $this->tableStrlen($REFERENCED_COLUMN_NAME, $len), $this->tableStrlen($REFERENCED_TABLE_NAME, $len)];
                if (!empty($REFERENCED_TABLE_NAME)) {
                    $plural_REFERENCED_TABLE_NAME = Str::plural($REFERENCED_TABLE_NAME);
                    $singular_REFERENCED_TABLE_NAME = Str::singular($REFERENCED_TABLE_NAME);
                    $ucfirst_singular_REFERENCED_TABLE_NAME = ucfirst($singular_REFERENCED_TABLE_NAME);
                    $ucfirst_plural_REFERENCED_TABLE_NAME = ucfirst($plural_REFERENCED_TABLE_NAME);
                    $constrints_tables_remote[$COLUMN_NAME] =
                        [
                        'REFERENCED_COLUMN_NAME' => $REFERENCED_COLUMN_NAME
                        , 'REFERENCED_TABLE_NAME' => $REFERENCED_TABLE_NAME,
                    ];
                    $constrints_tables_name[] = $singular_REFERENCED_TABLE_NAME;
                    $constrints_array[$plural_model_name][$COLUMN_NAME] = [
                        'prtn' => $plural_REFERENCED_TABLE_NAME,
                        'srtn' => $singular_REFERENCED_TABLE_NAME,
                        'uc_prtn' => $ucfirst_plural_REFERENCED_TABLE_NAME,
                        'uc_srtn' => $ucfirst_singular_REFERENCED_TABLE_NAME];
                    $ucfirst_table_plural = ucfirst($REFERENCED_TABLE_NAME);
                    $table_singular = Str::singular($REFERENCED_TABLE_NAME);
                    $ucfirst_table_singular = ucfirst($table_singular);
                }
            }
            if (!$hideAll && $showTables) {
                $this->table($headers, $constrints_list_to_show);
            }
            // views
            // views
            // index
            $stub_names = [
                $singular_model_name . "_add" => 'create_header'
                , $plural_model_name => 'index_header'
                , $singular_model_name . "_edit" => 'edit_header'
                , $singular_model_name . "_view" => 'show_header',
            ];
            if ($singular_model_name == 'user') {
                $stub_names['my_profile'] = 'my_profile_header';
            }
            $replace = ['{{name}}', '{{names}}', '{{uf_names}}'];
            $items = [$singular_model_name, $plural_model_name, ucfirst($plural_model_name)];
            $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
            // create | Update | show
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE = $column->DATA_TYPE;
                $COLUMN_COMMENT = $column->COLUMN_COMMENT;
                // $this->info('COLUMN_NAME : ' .$COLUMN_NAME . '| COLUMN_COMMENT : ' .$COLUMN_COMMENT);
                // if ($this->confirm('Add this ?'.$COLUMN_NAME)) {
                if (!in_array($COLUMN_NAME, $this->skipColumns)) {
                    $models = (isset($constrints_array[$plural_model_name][$COLUMN_NAME])) ? $constrints_array[$plural_model_name][$COLUMN_NAME] : false;
                    if (!in_array($COLUMN_NAME, $this->skipId)) {
                        if ($models && Str::endsWith($COLUMN_NAME, '_id')) {
                            //  $this->info("------------------------------------------------------".$COLUMN_NAME);
                            $stub_names = [
                                $singular_model_name . "_add" => 'select'
                                , $singular_model_name . "_edit" => 'show_select'
                                , $singular_model_name . "_view" => 'show_select',
                            ];
                            if ($singular_model_name == 'user') {
                                if ($COLUMN_NAME == 'user_type_id') {
                                    $stub_names['my_profile'] = 'show_select_disabled';
                                } else {
                                    $stub_names['my_profile'] = 'show_select';
                                }
                            }
                            $replace = ['{{models}}', '{{model}}', '{{colum_name}}', '{{name}}', '{{names}}', '{{main_colum_name}}'];
                            $items = [$models['prtn'], $models['srtn'], $COLUMN_NAME, $singular_model_name, $plural_model_name, $this->main_colum_name($models['prtn'], $conn)];
                            $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                        } else {
                            $textarea = ($this->option('ckeditor')) ? 'ckeditor_textarea' : 'textarea';
                            $show_textarea = ($this->option('ckeditor')) ? 'ckeditor_show_textarea' : 'show_textarea';
                            $input = ($DATA_TYPE == 'text' || $DATA_TYPE == 'longtext') ? $textarea : "input";
                            $show_input = ($DATA_TYPE == 'text' || $DATA_TYPE == 'longtext') ? $show_textarea : "show_input";
                            if (in_array($COLUMN_NAME, $this->files)) {
                                $input = "input_file";
                                $show_input = "show_input_file";
                            } elseif (in_array($COLUMN_NAME, $this->booleanValues) && !in_array($DATA_TYPE, $this->numericDataTypes)) { //      is_active | tinyint(1)
                                $input = "input_boolean";
                                $show_input = "show_input_boolan";
                            }
                            $type = "text";
                            if (in_array(strtoupper($DATA_TYPE), $this->numericDataTypes) && !in_array($COLUMN_NAME, $this->booleanValues)) {
                                $type = "number";
                            }
                            if (in_array(strtoupper($DATA_TYPE), $this->dateandTimeTypes) && !in_array($COLUMN_NAME, $this->booleanValues)) {
                                $type = "date";
                                if ($DATA_TYPE == "TIME") {
                                    $type = "time";
                                }
                            }
                            $stub_names = [
                                $singular_model_name . "_add" => $input
                                , $singular_model_name . "_edit" => $show_input
                                , $singular_model_name . "_view" => $show_input,
                            ];
                            if ($singular_model_name == 'user') {
                                $stub_names['my_profile'] = $show_input;
                            }
                            $replace = ['{{name}}', '{{names}}', '{{colum_name}}', '{{type}}'];
                            $items = [$singular_model_name, $plural_model_name, $COLUMN_NAME, $type];
                            $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                        }
                    }
                }
                // }
            }
            // index
            krsort($columns);
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE = $column->DATA_TYPE;
                if (!in_array($COLUMN_NAME, $this->skipColumns)) {
                    $stub_names = [
                        $plural_model_name => 'th_column',
                    ];
                    $replace = ['{{colum_name}}', '{{names}}'];
                    $items = [$COLUMN_NAME, $plural_model_name];
                    $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                }
            }
            $stub_names = [
                //  $singular_model_name."_add" => 'create_header'
                // ,
                $plural_model_name => 'table',
                //  , $singular_model_name."_edit" => 'edit_header'
                //  , $singular_model_name."_view" => 'show_header'
            ];
            $replace = ['{{name}}', '{{names}}'];
            $items = [$singular_model_name, $plural_model_name];
            $this->view_builder($stub_names, $replace, $items, $plural_model_name);
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE = $column->DATA_TYPE;
                if (!in_array($COLUMN_NAME, $this->skipColumns)) {
                    $stub_names = [
                        //  $singular_model_name."_add" => 'create_header'
                        // ,
                        $plural_model_name => 'th_column',
                        //  , $singular_model_name."_edit" => 'edit_header'
                        //  , $singular_model_name."_view" => 'show_header'
                    ];
                    $replace = ['{{name}}', '{{colum_name}}', '{{names}}'];
                    $items = [$singular_model_name, $COLUMN_NAME, $plural_model_name];
                    $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                }
            }
            $stub_names = [
                //  $singular_model_name."_add" => 'create_header'
                // ,
                $plural_model_name => 'index_endforeach',
                //  , $singular_model_name."_edit" => 'edit_header'
                //  , $singular_model_name."_view" => 'show_header'
            ];
            $replace = ['{{name}}', '{{names}}'];
            $items = [$singular_model_name, $plural_model_name];
            $this->view_builder($stub_names, $replace, $items, $plural_model_name);
            /// data for script
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE = $column->DATA_TYPE;
                if (!in_array($COLUMN_NAME, $this->skipColumns)) {
                    $stub_names = [
                        $plural_model_name => 'script_data',
                    ];
                    $replace = ['{{colum_name}}'];
                    $items = [$COLUMN_NAME];
                    $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                }
            }
            $stub_names = [
                //  $singular_model_name."_add" => 'create_header'
                // ,
                $plural_model_name => 'end_script',
                //  , $singular_model_name."_edit" => 'edit_header'
                //  , $singular_model_name."_view" => 'show_header'
            ];
            $replace = ['{{name}}', '{{names}}'];
            $items = [$singular_model_name, $plural_model_name];
            $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
            $create_footer = ($this->option('ckeditor')) ? 'ckeditor_create_footer' : 'create_footer';
            $show_footer = ($this->option('ckeditor')) ? 'ckeditor_show_footer' : 'show_footer';
            $stub_names = [
                $singular_model_name . "_add" => $create_footer
                , $plural_model_name => 'index_footer'
                , $singular_model_name . "_edit" => 'edit_footer'
                , $singular_model_name . "_view" => $show_footer,
            ];
            if ($singular_model_name == 'user') {
                $stub_names['my_profile'] = 'my_profile_footer';
            }
            $replace = ['{{name}}', '{{names}}'];
            $items = [$singular_model_name, $plural_model_name];
            $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
            // views
            // add use models
            $constrints_tables_name_unique = array_unique($constrints_tables_name);
            foreach ($constrints_tables_name_unique as $constrints_table_name) {
                $constrints_table_name_singular = Str::singular($constrints_table_name);
                $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                    $stub_name = ["apps"];
                    $replace = ['{{name}}', '{{app_name}}'];
                    $items = [$ucfirst_constrints_table_name_singular, $this->app_name];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
            }
            // controller class name & index function
            $stub_name = ["class_name", "index"];
            $replace = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // controller data table all data function
            $constrints_tables_name_unique = array_unique($constrints_tables_name);
            // create
            $stub_name = ["all_data"];
            $replace = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_remote as $key => $value) {
                // REFERENCED_COLUMN_NAME
                // REFERENCED_TABLE_NAME
                if (!in_array($key, ['created_by', 'updated_by'])) {
                    $REFERENCED_COLUMN_NAME = $value['REFERENCED_COLUMN_NAME'];
                    $REFERENCED_TABLE_NAME = $value['REFERENCED_TABLE_NAME'];
                    $stub_name = ["all_data_select"];
                    $replace = ['{{names}}', '{{name}}', '{{col_name}}', '{{main_colum_name}}'];
                    $items = [$REFERENCED_TABLE_NAME, Str::singular($REFERENCED_TABLE_NAME), $REFERENCED_COLUMN_NAME, $this->main_colum_name($REFERENCED_TABLE_NAME, $conn)];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
            }
            // create
            $stub_name = ["all_data_select_end"];
            $replace = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_remote as $key => $value) {
                // REFERENCED_COLUMN_NAME
                // REFERENCED_TABLE_NAME
                if (!in_array($key, ['created_by', 'updated_by'])) {
                    $REFERENCED_COLUMN_NAME = $value['REFERENCED_COLUMN_NAME'];
                    $REFERENCED_TABLE_NAME = $value['REFERENCED_TABLE_NAME'];
                    $stub_name = ["all_data_leftjoin"];
                    $replace = ['{{names}}', '{{name}}', '{{col_name}}', '{{tbl_name}}', '{{tbl_col_name}}'];
                    //$prtn    = Str::plural($value);
                    //$uc_srtn = ucfirst($value);
                    $items = [$REFERENCED_TABLE_NAME, Str::singular($REFERENCED_TABLE_NAME), $REFERENCED_COLUMN_NAME, $plural_model_name, $key];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
            }
            // create
            $stub_name = ["all_data_end"];
            $replace = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            // controller create function
            $stub_name = ["create"];
            $replace = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_name_unique as $value) {
                $stub_name = ["create_models"];
                $replace = ['{{names}}', '{{name}}'];
                $prtn = Str::plural($value);
                $uc_srtn = ucfirst($value);
                $items = [$prtn, $uc_srtn];
                $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            }
            // create
            $stub_name = ["create_return"];
            $replace = ['{{names}}', '{{name}}'];
            $items = [$plural_model_name, $singular_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_name_unique as $value) {
                $stub_name = ["create_with"];
                $replace = ['{{names}}'];
                $prtn = Str::plural($value);
                $items = [$prtn];
                $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            }
            // create
            $stub_name = ["store"];
            $replace = [];
            $items = [];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            krsort($columns);
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE = $column->DATA_TYPE;
                if (!in_array($COLUMN_NAME, $this->columnSkeps)) {
                    if (!in_array($COLUMN_NAME, $this->skipId) && !in_array($COLUMN_NAME, $this->booleanValues)) {
                        // create
                        $stub_name = ["validate_input"];
                        $replace = ['{{input}}'];
                        $items = [$COLUMN_NAME];
                        $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                        // create
                    }
                }
            }
            // create
            $stub_name = ["validate_end_tag"];
            $replace = ['{{name}}', '{{UC_name}}'];
            $items = [$singular_model_name, $ucfirst_singular_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE = $column->DATA_TYPE;
                if (in_array($COLUMN_NAME, $this->authColumns)) {
                    $stub_name = ["input_auth"];
                    $replace = ['{{name}}', '{{input}}'];
                    $items = [$singular_model_name, $COLUMN_NAME];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
                if (!in_array($COLUMN_NAME, $this->skipId) && !in_array($COLUMN_NAME, $this->skipColumns)) {
                    // create
                    $stub_name = ["input"];
                    $replace = ['{{name}}', '{{input}}'];
                    $items = [$singular_model_name, $COLUMN_NAME];
                    if (in_array($COLUMN_NAME, $this->files)) {
                        $stub_name = ["input_file"];
                        $replace = ['{{names}}', '{{name}}', '{{input}}'];
                        $items = [$plural_model_name, $singular_model_name, $COLUMN_NAME];
                    } elseif (in_array($COLUMN_NAME, $this->booleanValues)) {
                        $stub_name = ["input_boolean"];
                        $replace = ['{{name}}', '{{input}}'];
                        $items = [$singular_model_name, $COLUMN_NAME];
                    } elseif ($COLUMN_NAME == "password") {
                        $stub_name = ["input_password"];
                        $replace = ['{{name}}', '{{input}}'];
                        $items = [$singular_model_name, $COLUMN_NAME];
                    }
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                    // create
                }
            }
            // show
            // create
            $stub_name = ["craete_end"];
            $replace = ['{{class_name}}', '{{name}}', '{{names}}'];
            $items = [$ucfirst_singular_model_name, $singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            // create
            $stub_name = ["show"];
            $replace = ['{{names}}', '{{name}}', '{{UC_name}}'];
            $items = [$plural_model_name, $singular_model_name, ucfirst($singular_model_name)];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_name_unique as $constrints_table_name) {
                $constrints_table_name_singular = Str::singular($constrints_table_name);
                $constrints_table_name_plural = Str::plural($constrints_table_name);
                $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                // create
                if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                    $stub_name = ["show_models"];
                    $replace = ['{{name}}', '{{names}}'];
                    $items = [$ucfirst_constrints_table_name_singular, $constrints_table_name_plural];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                    // create
                }
            }
            // create
            $stub_name = ["show_return"];
            $replace = ['{{names}}', '{{name}}'];
            $items = [$plural_model_name, $singular_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($constrints_tables_name_unique as $value) {
                $constrints_table_name_singular = Str::singular($value);
                $constrints_table_name_plural = Str::plural($value);
                $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                // create
                if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                    $stub_name = ["show_with"];
                    $replace = ['{{names}}'];
                    $items = [$constrints_table_name_plural];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
            }
            // show
            // myprofile
            if ($singular_model_name == 'user') {
                $stub_name = ["my_profile"];
                $replace = ['{{name}}', '{{UC_name}}'];
                $items = [$singular_model_name, ucfirst($singular_model_name)];
                $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                // create
                foreach ($constrints_tables_name_unique as $constrints_table_name) {
                    $constrints_table_name_singular = Str::singular($constrints_table_name);
                    $constrints_table_name_plural = Str::plural($constrints_table_name);
                    $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                    // create
                    if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                        $stub_name = ["show_models"];
                        $replace = ['{{name}}', '{{names}}'];
                        $items = [$ucfirst_constrints_table_name_singular, $constrints_table_name_plural];
                        $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                        // create
                    }
                }
                // create
                $stub_name = ["my_profile_return"];
                $replace = ['{{names}}', '{{name}}'];
                $items = [$plural_model_name, $singular_model_name];
                $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                // create
                foreach ($constrints_tables_name_unique as $value) {
                    $constrints_table_name_singular = Str::singular($value);
                    $constrints_table_name_plural = Str::plural($value);
                    $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                    // create
                    if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                        $stub_name = ["show_with"];
                        $replace = ['{{names}}'];
                        $items = [$constrints_table_name_plural];
                        $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                    }
                }
                // show
            }
            // myprofile
            // create
            $stub_name = ["edit", "update"];
            $replace = ['{{name}}', '{{names}}', '{{UC_name}}'];
            $items = [$singular_model_name, $plural_model_name, $ucfirst_singular_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE = $column->DATA_TYPE;
                if ($COLUMN_NAME == "updated_by") {
                    $stub_name = ["input_auth"];
                    $replace = ['{{name}}', '{{input}}'];
                    $items = [$singular_model_name, $COLUMN_NAME];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
                if (!in_array($COLUMN_NAME, $this->skipId) && !in_array($COLUMN_NAME, $this->skipColumns)) {
                    // create
                    $stub_name = ["input"];
                    $replace = ['{{name}}', '{{input}}'];
                    $items = [$singular_model_name, $COLUMN_NAME];
                    if (in_array($COLUMN_NAME, $this->files)) {
                        $stub_name = ["input_file"];
                        $replace = ['{{names}}', '{{name}}', '{{input}}'];
                        $items = [$plural_model_name, $singular_model_name, $COLUMN_NAME];
                    } elseif (in_array($COLUMN_NAME, $this->booleanValues)) {
                        $stub_name = ["input_boolean"];
                        $replace = ['{{name}}', '{{input}}'];
                        $items = [$singular_model_name, $COLUMN_NAME];
                    } elseif ($COLUMN_NAME == "password") {
                        $stub_name = ["input_password"];
                        $replace = ['{{name}}', '{{input}}'];
                        $items = [$singular_model_name, $COLUMN_NAME];
                    }
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                    // create
                }
            }
            // create
            $stub_name = ["footer"];
            $replace = ['{{name}}', '{{UC_name}}'];
            $items = [$singular_model_name, $ucfirst_singular_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
        }
    }
}
