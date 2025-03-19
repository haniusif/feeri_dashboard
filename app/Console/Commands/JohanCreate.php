<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JohanCreate extends johan
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:create
    {--models : create views with models }
    {--theam=vuexy : sellect theams }
    {--del :  delete all views ,controllers and routes for selected table }
    {--table=all :  table name }
    {--ckeditor :  use ckeditor with text and longtext  }
    {--msg :  show msgs  }
    {--controller :  with controller or not  }
    {--hide : hide tables and translate result}
    {--d :  create views  with details }
    {--translate :  translate table to arabic using google translator }
    {--tables :  show all tables details  }
    {--all :  select all columns }
    {--row :  use row insted off datatable  }
    {--datatable :  use datatable }
    {--dir=ltr :  select dir }

    {--append :  append colums }
    {--constrints :  add custom constrints }



    ';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Edit Show & Create View';

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

        $append = []; // appended columns
        $constrints_array = [];
        $constrints_tables_name = [];
        $constrints_tables_remote = [];

        $askme = false;
        if ($this->option('d')) {
            $askme = true;
        }

        if ($this->option('dir') && in_array($this->option('dir'), ['rtl', 'ltr'])) {
            $dir = $this->option('dir');
            $theamDir = in_array($dir, ['rtl', 'ltr']) ? $dir : 'ltr';

        } else {

            $theamDir = $this->choice(
                'Select dir',
                ['rtl', 'ltr'],
                1
            );
        }

        $HaveConstrints = false;
        if ($this->option('constrints')) {
            $HaveConstrints = true;

        }

        $haveAppend = false;
        if ($this->option('append')) {
            $haveAppend = true;

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

        $selectAll = false;
        if ($this->option('all')) {
            $selectAll = true;
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

        $dbname = $this->DB_NAME();

        $headers = ['LIST OF TABLEs', 'COUNT OF COLUMS'];

        $tables = $this->tables($this->skipTables);

        $table_list = [];

        foreach ($tables as $key => $table_value) {
            $tables_arr[] = $key;
            $column_count = count($table_value);
            $table_list[] = $key;
            $table_list_to_show[] = [$key, $column_count];
        }

        if (!$hideAll) {
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
        $this->info('selected table : ' . $tableName);
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

        if ($this->option('del')) {

            $plural_model_name = Str::plural($tableName);
            $singular_model_name = Str::singular($tableName);
            $ucfirst_singular_model_name = ucfirst($singular_model_name);
            $ucfirst_plural_model_name = ucfirst($plural_model_name);

            $createfile = "resources/views/" . $this->app_name . "/" . $tableName . "/" . $singular_model_name . "_add.blade.php";
            $viewfile = "resources/views/" . $this->app_name . "/" . $tableName . "/" . $singular_model_name . "_view.blade.php";

            $this->unlink_file($viewfile);

            $phrase = "/stubs/make/forms/" . $theamName . "/create_header.stub";
            $replace = ['{{name}}', '{{names}}'];
            $items = [$ucfirst_singular_model_name, $plural_model_name];
            $create = $this->create($phrase, $replace, $items);
            file_put_contents($createfile, $create);

        }

        $model_name = $tableName;

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

        if ($withController) {

            // create controller header
            $phrase = "/stubs/make/controllers/header.stub";
            $replace = ['{{name}}', '{{app_name}}'];
            $items = [$ucfirst_singular_model_name, $this->app_name];
            $create = $this->create($phrase, $replace, $items);
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

        $columns = DB::select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$plural_model_name'");

        $getColumns = $this->getColumns($plural_model_name);

        print_r('getColumns');
        print_r($getColumns);

        // index

        $stub_names = [
            // $singular_model_name."_add" => 'create_header' ,
            //  , $plural_model_name => ($useDatatable) ? 'index_header' : 'pure_index_header'
            $singular_model_name . "_edit" => 'edit_header',
            $singular_model_name . "_view" => 'show_header',
        ];

        $replace = ['{{name}}', '{{names}}'];
        $items = [$singular_model_name, $plural_model_name];
        $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);

        // create | Update | show

        $not_add = [];
        if ($theamDir == 'ltr') {
            krsort($columns);
        }

        $colspan = 1;
        foreach ($columns as $column) {
            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE = $column->DATA_TYPE;

            if (!in_array($COLUMN_NAME, $this->skipColumns) && !in_array($COLUMN_NAME, $this->skipId)) {

                if (!$selectAll && $askme && !$this->confirm('Add ' . $COLUMN_NAME . ' to index ?', 'yes')) {

                    $not_add[] = $COLUMN_NAME;

                }
            }

        }

        $getConstrints = $this->getConstrints($tableName);
        print_r('getConstrints');
        print_r($getConstrints);

        if (isset($getConstrints['constrints_array'][$tableName])) {
            $constrints_array[$tableName] = $getConstrints['constrints_array'][$tableName];
        }
        if ($HaveConstrints) {

            $numbers_of_const = $this->ask('Enter the number off constrints ');

            for ($i = 0; $i < $numbers_of_const; $i++) {
                $DrowAppends = $this->DrowAppends($table_list);

                $constrints_array[$tableName][$DrowAppends['columnName']] = $DrowAppends['constrints_array'][$tableName][$DrowAppends['columnName']];
                $constrints_tables_name[] = $DrowAppends['constrints_tables_name'][0];
                $append[] = $DrowAppends['append'][0];

            }

        }

        $columns = array_merge($columns, $append);
        if (isset($getConstrints['constrints_tables_name'])) {
            $constrints_tables_name = array_merge($constrints_tables_name, $getConstrints['constrints_tables_name']);
        }

        //   $this->confirm('Do you wont to append other columns ?');

        if ($haveAppend) {
            $DrowAppends = $this->DrowAppends($table_list);
            $columns = array_merge($columns, $DrowAppends['append']);
        }

        //$constrints_tables_name =  array_merge($getConstrints['constrints_tables_name'] , $DrowAppends['constrints_tables_name'] );

        print_r('columns');
        print_r($columns);
        print_r('append');
        print_r($append);
        print_r('constrints_array');
        print_r($constrints_array);
        print_r('constrints_tables_name');
        print_r($constrints_tables_name);
        print_r('constrints_tables_remote');
        print_r($constrints_tables_remote);

        foreach ($columns as $column) {

            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE = $column->DATA_TYPE;
            $COLUMN_COMMENT = $column->COLUMN_COMMENT;
            $this->info('COLUMN_NAME : ' . $COLUMN_NAME . '| COLUMN_COMMENT : ' . $COLUMN_COMMENT);

            // if ($this->confirm('Add this ?'.$COLUMN_NAME)) {

            if (!in_array($COLUMN_NAME, $this->skipColumns) && !in_array($COLUMN_NAME, $not_add)) {

                $models = (isset($constrints_array[$plural_model_name][$COLUMN_NAME])) ? $constrints_array[$plural_model_name][$COLUMN_NAME] : false;

                if (!in_array($COLUMN_NAME, $this->skipId)) {
                    if ($models && Str::endsWith($COLUMN_NAME, '_id')) {

                        $this->info("--------------------endsWithID----------------------------------" . $COLUMN_NAME);

                        $select = 'select';
                        $show_select = 'show_select';

                        if (isset($column->columnNameInput)) {
                            $this->info("--------------------columnNameInput----------------------------------" . $column->columnNameInput);

                            if ($column->columnNameInput == 'select_checkbox') {
                                $select = 'select_checkbox';
                                $show_select = 'show_select_checkbox';
                            } elseif ($column->columnNameInput == 'select') {

                                $select = 'select';
                                $show_select = 'show_select';

                            } else {

                                $select = 'select_checkbox';
                                $show_select = 'show_select_checkbox';
                            }

                        }
                        $stub_names = [
                            $singular_model_name . "_add" => $select
                            , $singular_model_name . "_edit" => $show_select
                            , $singular_model_name . "_view" => $show_select,
                        ];

                        if ($singular_model_name == 'user') {
                            if ($COLUMN_NAME == 'user_type_id') {
                                $stub_names['my_profile'] = 'show_select_disabled';

                            } else {
                                $stub_names['my_profile'] = 'show_select';

                            }
                        }

                        $replace = ['{{models}}', '{{model}}', '{{colum_name}}', '{{name}}', '{{names}}', '{{main_colum_name}}'];
                        $items = [$models['prtn'], $models['srtn'], $COLUMN_NAME, $singular_model_name, $plural_model_name, $this->main_colum_name($models['prtn'])];
                        $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);

                    } else {

                        $this->info("------------------------------------------------------" . $COLUMN_NAME);

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

        }

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

        if ($withController) {

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

            $indexStub = ($useDatatable) ? 'index' : 'pure_index';
            // controller class name & index function
            $stub_name = ["class_name", $indexStub];
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
                    $items = [$REFERENCED_TABLE_NAME, Str::singular($REFERENCED_TABLE_NAME), $REFERENCED_COLUMN_NAME, $this->main_colum_name($REFERENCED_TABLE_NAME)];
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
            if ($theamDir == 'ltr') {
                krsort($columns);
            }
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

    public function getColumns($table)
    {
        $dbname = $this->DB_NAME();

        $columns = DB::select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table'");

        $arr = [];
        foreach ($columns as $column) {
            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE = $column->DATA_TYPE;

            if (!in_array($COLUMN_NAME, $this->skipColumns) && !in_array($COLUMN_NAME, $this->skipId)) {

                $arr[] = $COLUMN_NAME;
            }

        }

        return $arr;

    }

    public function DrowAppends($table_list)
    {

        $append = []; // appended columns

        if ($this->option('table') && in_array($this->option('table'), $table_list)) {

            $tableName = $this->option('table');

        } else {

            $tableName = $this->choice(
                'Select table',
                $table_list,
                null
            );
        }

        $this->info('selected table : ' . $tableName);

        $AppendTableName = $this->choice(
            'Select table',
            $table_list,
            null
        );
        $this->info($AppendTableName . ' Selected');

        $columnName = $this->choice(
            'Select table',
            $this->getColumns($AppendTableName),
            null
        );

        $this->info($AppendTableName . ":" . $columnName);

        $columnNameInput = $this->choice(
            'Select inputs',
            $this->inputs,
            4
        );

////if($columnNameInput == 'select_checkbox'){
        $appendsingle = [

            'COLUMN_NAME' => $columnName . "_id",
            'DATA_TYPE' => "bigint",
            'COLUMN_COMMENT' => "",
            'columnNameInput' => $columnNameInput,
        ];

        $append[] = (object) $appendsingle;

        $plural_REFERENCED_TABLE_NAME = Str::plural($AppendTableName);
        $singular_REFERENCED_TABLE_NAME = Str::singular($AppendTableName);
        $ucfirst_singular_REFERENCED_TABLE_NAME = ucfirst($singular_REFERENCED_TABLE_NAME);
        $ucfirst_plural_REFERENCED_TABLE_NAME = ucfirst($plural_REFERENCED_TABLE_NAME);

        $constrints_tables_name[] = $singular_REFERENCED_TABLE_NAME;

// arr[model name][column name] = [];
        $constrints_array = [];

        $constrints_array[$tableName][$columnName . "_id"] = [
            'prtn' => $plural_REFERENCED_TABLE_NAME,
            'srtn' => $singular_REFERENCED_TABLE_NAME,
            'uc_prtn' => $ucfirst_plural_REFERENCED_TABLE_NAME,
            'uc_srtn' => $ucfirst_singular_REFERENCED_TABLE_NAME];

//}

        return [
            'columnName' => $columnName . "_id",
            'constrints_array' => $constrints_array,
            'columnNameInput' => $columnNameInput,
            'constrints_tables_name' => $constrints_tables_name,
            'append' => $append,
        ];

    }

    public function getConstrints($plural_model_name, $all = 1)
    {

        $dbname = $this->DB_NAME();
        $constrints_array = [];
        $constrints = DB::select("select COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME
  from information_schema.KEY_COLUMN_USAGE
  where TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$plural_model_name'");

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

            }
        }

        $hideAll = false;
        if ($this->option('hide')) {
            $hideAll = true;

        }

        $showTables = false;
        if ($this->option('tables')) {
            $showTables = true;

        }

        if (!$hideAll && $showTables) {
            $this->table($headers, $constrints_list_to_show);
        }

        if (count($constrints_array) >= 1) {
            return ($all == 1) ? ['constrints_array' => $constrints_array, 'constrints_tables_name' => $constrints_tables_name] : $constrints_array;
        } else {
            return [];
        }
    }

}
