<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JohanSearch extends johan
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:search
    {--theam=vuexy : sellect theams }
    {--del :  delete all views ,controllers and routes for selected table }
    {--table=all :  table name }
    {--msg :  show msgs  }
    {--function :  with controller function  }
    {--hide : hide tables and translate result}
    {--d :  create views  with details }
    {--translate :  translate table to arabic using google translator }
    {--tables :  show all tables details  }
    {--row :  use row insted off datatable  }
    {--dir=ltr :  select dir }


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

        $withFunction = false;
        if ($this->option('function')) {
            $withFunction = true;

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

        $useDatatable = false;

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

        $searchDir = $tableName . '/search';

        $this->info('searchDir : ' . $searchDir);

        if ($this->option('del')) {
            $file_pointer = "resources/views/" . $this->app_name . "/" . $searchDir . "/search.blade.php";
            if (file_exists($file_pointer)) {
                $this->unlink_file($file_pointer);
            } else {
                $this->info('No such file or directory : ' . $file_pointer);
            }

            $file_pointer = "resources/views/" . $this->app_name . "/functions/function.txt";
            if (file_exists($file_pointer)) {
                $this->unlink_file($file_pointer);
            } else {
                $this->info('No such file or directory : ' . $file_pointer);
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

        $this->info('selected table : ' . $tableName);
        $model_name = $tableName;

        $plural_model_name = Str::plural($model_name);
        $singular_model_name = Str::singular($model_name);
        $ucfirst_singular_model_name = ucfirst($singular_model_name);
        $ucfirst_plural_model_name = ucfirst($plural_model_name);
        // $this->info("".$plural_model_name.":".$ucfirst_plural_model_name.":".$singular_model_name."".$ucfirst_singular_model_name);
        $viewsDir = "resources/views/$this->app_name/" . $searchDir;
        $functionsDir = "resources/views/$this->app_name/functions";

        $this->create_dir($viewsDir);
        $this->create_dir($functionsDir);

        // fill use array

        $columns = DB::select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
                    FROM INFORMATION_SCHEMA.COLUMNS
                    WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$plural_model_name'");
        $constrints = DB::select("select COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME
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

        $stub_names = [$plural_model_name => 'search_header'];
        $replace = ['{{name}}', '{{names}}'];
        $items = [$singular_model_name, $plural_model_name];
        $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

        $not_add = [];
        $custom_column = [];
        $custom_datatype = [];
        $modelsForImport = [$ucfirst_singular_model_name];
        $columnsForFunction = [];

        // index

        if ($theamDir == 'ltr') {
            krsort($columns);
        }

        $colspan = 1;
        foreach ($columns as $column) {
            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE = $column->DATA_TYPE;
            if ($askme) {
                $anser_add_choice = $this->choice('Add ' . $COLUMN_NAME . ' to search form  ?', ['yes', 'no', 'yes as constrints'], 0);

                $custom_column = [];

                if ($anser_add_choice == 'no') {
                    $not_add[] = $COLUMN_NAME;
                } elseif ($anser_add_choice == 'yes as constrints') {

                    $customConstrint = $this->choice(
                        'Select table ',
                        $table_list,
                        null

                    );

                    $plural_customConstrint = Str::plural($customConstrint);
                    $singular_customConstrint = Str::singular($customConstrint);
                    $ucfirst_singular_customConstrint = ucfirst($singular_customConstrint);
                    $ucfirst_plural_customConstrint = ucfirst($plural_customConstrint);

                    $constrints_array[$plural_model_name][$COLUMN_NAME] = [
                        'prtn' => $plural_customConstrint,
                        'srtn' => $singular_customConstrint,
                        'uc_prtn' => $ucfirst_plural_customConstrint,
                        'uc_srtn' => $ucfirst_singular_customConstrint];

                } else {

                    $confirm_DATA_TYPE = $this->confirm($COLUMN_NAME . ' is ' . $DATA_TYPE . '  ?', 'yes');

                    if (!$confirm_DATA_TYPE) {

                        $custom_DATA_TYPE = $this->choice(
                            'Select ' . $COLUMN_NAME . ' datatype',
                            $this->inputsDataType,
                            0

                        );
                    }

                }

            }

            if (!in_array($COLUMN_NAME, $this->skipColumns) && !in_array($COLUMN_NAME, $not_add)) {

                $models = (isset($constrints_array[$plural_model_name][$COLUMN_NAME])) ? $constrints_array[$plural_model_name][$COLUMN_NAME] : false;

                if ($models) {

                    $modelsForImport[] = $models['uc_srtn'];

                    $stub_names = [$plural_model_name => 'search_constrints'];

                    $replace = ['{{models}}', '{{model}}', '{{colum_name}}', '{{name}}', '{{names}}', '{{main_colum_name}}'];
                    $items = [$models['prtn'], $models['srtn'], $COLUMN_NAME, $singular_model_name, $plural_model_name, $this->main_colum_name($models['prtn'])];
                    $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                    $columnsForFunction[] = ['COLUMN_NAME' => $COLUMN_NAME, 'DATA_TYPE' => $DATA_TYPE, 'CUSTOM' => 0, 'MODEL' => $models['uc_srtn']];

                } else {

                    if (isset($custom_DATA_TYPE) && $custom_DATA_TYPE != null) {

                        $columnsForFunction[] = ['COLUMN_NAME' => $COLUMN_NAME, 'DATA_TYPE' => $custom_DATA_TYPE, 'CUSTOM' => 1, 'MODEL' => 0];

                        if (in_array($custom_DATA_TYPE, ['boolean'])) {

                            $stub_names = [$plural_model_name => 'search_boolean'];

                            $replace = ['{{colum_name}}', '{{names}}'];
                            $items = [$COLUMN_NAME, $plural_model_name];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        } elseif (in_array($custom_DATA_TYPE, ['text'])) {

                            $stub_names = [$plural_model_name => 'search_string'];

                            $replace = ['{{colum_name}}', '{{names}}'];
                            $items = [$COLUMN_NAME, $plural_model_name];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        } elseif (in_array($custom_DATA_TYPE, ['rate'])) {

                            $stub_names = [$plural_model_name => 'search_rate'];

                            $replace = ['{{colum_name}}', '{{names}}'];
                            $items = [$COLUMN_NAME, $plural_model_name];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        } elseif (in_array($custom_DATA_TYPE, ['daterange'])) {

                            $stub_names = [$plural_model_name => 'search_daterange'];

                            $replace = ['{{colum_name}}', '{{names}}'];
                            $items = [$COLUMN_NAME, $plural_model_name];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        } elseif (in_array($custom_DATA_TYPE, ['number'])) {

                            $stub_names = [$plural_model_name => 'search_init'];

                            $replace = ['{{colum_name}}', '{{names}}'];
                            $items = [$COLUMN_NAME, $plural_model_name];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        } else {

                            $stub_names = [$plural_model_name => 'search_custom'];

                            $replace = ['{{colum_name}}', '{{names}}', '{{type}}'];
                            $items = [$COLUMN_NAME, $plural_model_name, $custom_DATA_TYPE];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        }

                    } else {

                        $columnsForFunction[] = ['COLUMN_NAME' => $COLUMN_NAME, 'DATA_TYPE' => $DATA_TYPE, 'CUSTOM' => 0, 'MODEL' => 0];

                        if (in_array($DATA_TYPE, ['tinyint'])) {

                            $stub_names = [$plural_model_name => 'search_boolean'];

                            $replace = ['{{colum_name}}', '{{names}}'];
                            $items = [$COLUMN_NAME, $plural_model_name];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        } elseif (in_array(strtoupper($DATA_TYPE), $this->dateandTimeTypes)) {

                            $stub_names = [$plural_model_name => 'search_custom'];

                            $replace = ['{{colum_name}}', '{{names}}', '{{type}}'];
                            $items = [$COLUMN_NAME, $plural_model_name, 'date'];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        } elseif (in_array(strtoupper($DATA_TYPE), $this->stringTypes)) {

                            $stub_names = [$plural_model_name => 'search_string'];

                            $replace = ['{{colum_name}}', '{{names}}'];
                            $items = [$COLUMN_NAME, $plural_model_name];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        } elseif (in_array(strtoupper($DATA_TYPE), $this->numericDataTypes)) {

                            $stub_names = [$plural_model_name => 'search_init'];

                            $replace = ['{{colum_name}}', '{{names}}'];
                            $items = [$COLUMN_NAME, $plural_model_name];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        } else {

                            $stub_names = [$plural_model_name => 'search_select'];

                            $replace = ['{{colum_name}}', '{{names}}'];
                            $items = [$COLUMN_NAME, $plural_model_name];
                            $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

                        }

                    }
                }

            }

            $custom_DATA_TYPE = null;
        }

        $stub_names = [$plural_model_name => 'search_footer'];

        $replace = ['{{name}}', '{{names}}'];
        $items = [$singular_model_name, $plural_model_name];
        $this->search_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

        if ($withFunction) {

            if (!$hideAll) {
                $this->info('modelsForImport');
                print_r($modelsForImport);
            }

            foreach ($modelsForImport as $imodel) {
                $stub_names = [$plural_model_name => 'search_model_for_import'];
                $replace = ['{{name}}', '{{app_name}}'];
                $items = [$imodel, $this->app_name];
                $this->search_function_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);
            }

            if (!$hideAll) {
                $this->info('columnsForFunction');

                print_r($columnsForFunction);
            }

            foreach ($columnsForFunction as $key => $colmn) {

                if ($key == 0) {
                    $stub_names = [$plural_model_name => 'search_function_header'];
                    $replace = ['{{names}}', '{{colum_name}}', '{{UC_name}}'];
                    $items = [$plural_model_name, $colmn['COLUMN_NAME'], $ucfirst_singular_model_name];
                    $this->search_function_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);
                }

                if ($colmn['CUSTOM'] == 1) {

                    $this->CustomColumnsForFunction($colmn, $plural_model_name, $theamName, $searchDir);
                } else {
                    $this->ColumnsForFunction($colmn, $plural_model_name, $theamName, $searchDir);

                }

                if ($key == (count($columnsForFunction) - 1)) {
                    $stub_names = [$plural_model_name => 'search_function_footer'];
                    $replace = ['{{colum_name}}'];
                    $items = [$colmn['COLUMN_NAME']];
                    $this->search_function_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);
                }

            }

            $file_pointer = "resources/views/" . $this->app_name . "/functions/function.txt";
            if (file_exists($file_pointer)) {
                $file_get_contents = file_get_contents($file_pointer);

                if (!$hideAll) {
                    $this->info('columnsForFunction is');

                    print_r($file_get_contents);
                } else {
                    $this->info('check file at : ' . $file_pointer);

                }

            } else {
                $this->info('No such file or directory : ' . $file_pointer);
            }

        }

    }

    public function CustomColumnsForFunction($colmn, $plural_model_name, $theamName, $searchDir)
    {

        if (in_array($colmn['DATA_TYPE'], ['boolean'])) {

            $stub_names = [$plural_model_name => 'search_function_column_boolean'];
            $replace = ['{{colum_name}}'];
            $items = [$colmn['COLUMN_NAME']];
            $this->search_function_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

        } elseif (in_array($colmn['DATA_TYPE'], ['daterange', 'range'])) {

            $stub_names = [$plural_model_name => 'search_function_column_daterange'];

            $replace = ['{{colum_name}}'];
            $items = [$colmn['COLUMN_NAME']];
            $this->search_function_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

        } else {

            $stub_names = [$plural_model_name => 'search_function_column_string'];

            $replace = ['{{colum_name}}'];
            $items = [$colmn['COLUMN_NAME']];
            $this->search_function_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

        }

    }

    public function ColumnsForFunction($colmn, $plural_model_name, $theamName, $searchDir)
    {

        if (in_array($colmn['DATA_TYPE'], ['tinyint'])) {

            $stub_names = [$plural_model_name => 'search_function_column_boolean'];

            $replace = ['{{colum_name}}'];
            $items = [$colmn['COLUMN_NAME']];
            $this->search_function_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

        } else {
            $stub_names = [$plural_model_name => 'search_function_column_string'];

            $replace = ['{{colum_name}}'];
            $items = [$colmn['COLUMN_NAME']];
            $this->search_function_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $searchDir);

        }

    }

    protected function search_function_builder($stub_names = [], $replace = [], $items = [], $plural_model_name, $theam = 'ace', $reportDir = null)
    {

        foreach ($stub_names as $key => $stub_name) {
            $phrase = "/stubs/make/forms/" . $theam . "/search/" . $stub_name . ".stub";

            $compileViewHeader = $this->create_views($phrase, $replace, $items);
            file_put_contents(
                base_path("resources/views/$this->app_name/functions/function.txt"),
                $compileViewHeader,
                FILE_APPEND
            );
        }
    }

}
