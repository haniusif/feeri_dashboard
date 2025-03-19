<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JohanShow extends johan
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:show
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
    {--row :  use row insted off datatable  }
    {--datatable :  use datatable }
    {--dir=ltr :  select dir }

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

            $createfile = "resources/views/" . $this->app_name . "/" . $tableName . "/" . $singular_model_name . "_view.blade.php";

            $file_pointer = "gfg.txt";

// Use unlink() function to delete a file
            if (!unlink($createfile)) {
                echo ("$createfile cannot be deleted due to an error");
            } else {
                echo ("$createfile has been deleted");
            }

            $phrase = "/stubs/make/forms/" . $theamName . "/show_header.stub";
            $replace = ['{{name}}', '{{names}}'];
            $items = [$singular_model_name, $plural_model_name];
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

        $this->create_dir($viewsDir);
        $this->create_dir($Controllers_folder);

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

        $stub_names = [
            // $singular_model_name."_add" => 'create_header' ,

            //  , $plural_model_name => ($useDatatable) ? 'index_header' : 'pure_index_header'
            $singular_model_name . "_edit" => 'edit_header',
            //  $singular_model_name."_view" => 'show_header' ,
        ];

        if ($singular_model_name == 'user') {
            //  $stub_names['my_profile'] =  ($useDatatable) ? 'my_profile_header' : 'pure_my_profile_header';
        }

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

                if ($askme && !$this->confirm('Add ' . $COLUMN_NAME . ' to show.blade.php ?', 'yes')) {
                    $not_add[] = $COLUMN_NAME;
                }
            }

        }

        foreach ($columns as $column) {

            $COLUMN_NAME = $column->COLUMN_NAME;
            $DATA_TYPE = $column->DATA_TYPE;
            $COLUMN_COMMENT = $column->COLUMN_COMMENT;
            // $this->info('COLUMN_NAME : ' .$COLUMN_NAME . '| COLUMN_COMMENT : ' .$COLUMN_COMMENT);

            // if ($this->confirm('Add this ?'.$COLUMN_NAME)) {

            if (!in_array($COLUMN_NAME, $this->skipColumns) && !in_array($COLUMN_NAME, $not_add)) {
                $models = (isset($constrints_array[$plural_model_name][$COLUMN_NAME])) ? $constrints_array[$plural_model_name][$COLUMN_NAME] : false;
                if (!in_array($COLUMN_NAME, $this->skipId)) {
                    if ($models && Str::endsWith($COLUMN_NAME, '_id')) {

                        //  $this->info("------------------------------------------------------".$COLUMN_NAME);

                        $stub_names = [
                            // $singular_model_name."_add" => 'select'
                            $singular_model_name . "_edit" => 'show_select',
                            $singular_model_name . "_view" => 'show_select',
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

                        $textarea = ($this->option('ckeditor')) ? 'ckeditor_textarea' : 'textarea';
                        $show_textarea = ($this->option('ckeditor')) ? 'ckeditor_show_textarea' : 'show_textarea';

                        $input = ($DATA_TYPE == 'text' || $DATA_TYPE == 'longtext') ? $textarea : "input";
                        $show_input = ($DATA_TYPE == 'text' || $DATA_TYPE == 'longtext') ? $show_textarea : "show_input";
                        if (in_array($COLUMN_NAME, $this->files)) {
                            // $input =  "input_file" ;
                            $show_input = "show_input_file";
                        } elseif (in_array($COLUMN_NAME, $this->booleanValues) && !in_array($DATA_TYPE, $this->numericDataTypes)) { //      is_active | tinyint(1)
                            //  $input = "input_boolean";
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
                            //  $singular_model_name."_add" => $input ,

                            $singular_model_name . "_edit" => $show_input,
                            $singular_model_name . "_view" => $show_input,
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

        $show_footer = ($this->option('ckeditor')) ? 'ckeditor_show_footer' : 'show_footer';

        $stub_names = [
            //  $singular_model_name."_add" => $create_footer

            // , $plural_model_name => 'index_footer'
            $singular_model_name . "_edit" => 'edit_footer',
            $singular_model_name . "_view" => $show_footer,
        ];

        if ($singular_model_name == 'user') {
            $stub_names['my_profile'] = 'my_profile_footer';
        }

        $replace = ['{{name}}', '{{names}}'];
        $items = [$singular_model_name, $plural_model_name];
        $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);

    }

}
