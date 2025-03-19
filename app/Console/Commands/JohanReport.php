<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JohanReport extends johan
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:report
    {--theam=vuexy : sellect theams }
    {--del :  delete all views ,controllers and routes for selected table }
    {--table=all :  table name }
    {--reportdir=reports :  report directory }
    {--msg :  show msgs  }
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

        $reportDir = 'reports';

        if ($this->option('reportdir')) {
            $reportDir = $this->option('reportdir');

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

        if ($this->option('del')) {
            $file_pointer = "resources/views/" . $this->app_name . "/" . $reportDir . "/" . $tableName . ".blade.php";
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
        $viewsDir = "resources/views/$this->app_name/" . $reportDir;

        $this->create_dir($viewsDir);

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

        $stub_names = [$plural_model_name => 'report_header'];
        $replace = ['{{name}}', '{{names}}'];
        $items = [$singular_model_name, $plural_model_name];
        $this->report_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $reportDir);

        $not_add = [];
        $custom_column = [];

        // index

        if ($theamDir == 'ltr') {
            krsort($columns);
        }

        $colspan = 1;
        foreach ($columns as $column) {
            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE = $column->DATA_TYPE;
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

            if (!in_array($COLUMN_NAME, $this->skipColumns) && !in_array($COLUMN_NAME, $not_add)) {

                $stub_names = [
                    $plural_model_name => ($useDatatable) ? 'th_column' : 'pure_th_column',

                ];
                $replace = ['{{colum_name}}', '{{names}}'];
                $items = [$COLUMN_NAME, $plural_model_name];
                $this->report_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $reportDir);
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
        $items = [$singular_model_name, $plural_model_name];
        $this->report_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $reportDir);

        if ($theamDir == 'ltr') {
            krsort($columns);
        }
        $colspan = 1;

        print_r($custom_column);

        foreach ($columns as $column) {
            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE = $column->DATA_TYPE;

            if (!in_array($COLUMN_NAME, $this->skipColumns) && !in_array($COLUMN_NAME, $not_add) && in_array($COLUMN_NAME, $custom_column)) {

                $stub_names = [
                    $plural_model_name => ($useDatatable) ? 'td_column' : 'pure_td_column',

                ];

                $new_colum_name = $this->ask("replace " . $COLUMN_NAME . " with ?");

                $new_colum_name = ($new_colum_name) ? $new_colum_name : $COLUMN_NAME;
                $replace = ['{{name}}', '{{colum_name}}', '{{names}}'];
                $items = [$singular_model_name, $new_colum_name, $plural_model_name];
                $this->report_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $reportDir);
                $colspan++;

            } elseif (!in_array($COLUMN_NAME, $this->skipColumns) && !in_array($COLUMN_NAME, $not_add) && !in_array($COLUMN_NAME, $custom_column)) {

                $stub_names = [
                    $plural_model_name => ($useDatatable) ? 'td_column' : 'pure_td_column',

                ];
                $replace = ['{{name}}', '{{colum_name}}', '{{names}}'];
                $items = [$singular_model_name, $COLUMN_NAME, $plural_model_name];
                $this->report_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $reportDir);
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
        $items = [$singular_model_name, $plural_model_name, $colspan];
        $this->report_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $reportDir);

        /// data for script

        foreach ($columns as $column) {
            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE = $column->DATA_TYPE;

            if (!in_array($COLUMN_NAME, $this->skipColumns) && !in_array($COLUMN_NAME, $not_add)) {

                $stub_names = [
                    $plural_model_name => ($useDatatable) ? 'script_data' : 'pure_script_data',

                ];
                $replace = ['{{colum_name}}'];
                $items = [$COLUMN_NAME];
                $this->report_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $reportDir);

            }
        }

        $stub_names = [

            $plural_model_name => ($useDatatable) ? 'end_script' : 'pure_end_script',

        ];
        $replace = ['{{name}}', '{{names}}'];
        $items = [$singular_model_name, $plural_model_name];
        $this->report_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $reportDir);

        $stub_names = [

            $plural_model_name => 'index_footer',

        ];

        $replace = ['{{name}}', '{{names}}'];
        $items = [$singular_model_name, $plural_model_name];
        $this->report_view_builder($stub_names, $replace, $items, $plural_model_name, $theamName, $reportDir);

    }

}
