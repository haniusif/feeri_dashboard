<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JohanLang extends johan
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:lang
    {--sleep :  every 10 member sleep 5 second then continue }
    {--del :  delete all old translation files }
    {--translate :  translate all to arabic using google translate }
    ';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Lang Files';
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
        $translate = false;
        if ($this->option('translate')) {
            $translate = true;
        }
        $del = false;
        if ($this->option('del')) {
            $del = true;
        }
        $sleep = false;
        if ($this->option('sleep')) {
            $sleep = true;
        }
        $dbname = $this->DB_NAME();
        $tables = $this->tables($this->skipTables);
        foreach ($tables as $key => $table_value) {
            $column_count         = count($table_value);
            $table_list[]         = $key;
            $table_list_to_show[] = [$key, $column_count];
        }
        if ($del) {
            $reset = true;
        } else {
            $reset = $this->confirm("Do you wont to reset lang translation", 'yes');
        }
        if ($reset) {
            // resources\lang\en
            $json_lang_folder = "lang/temp/";
            $this->create_dir($json_lang_folder);
            $phrase = "/stubs/make/lang/json_header.stub";
            $create = $this->create($phrase);
            file_put_contents($json_lang_folder . "ar.json", $create);
            file_put_contents($json_lang_folder . "en.json", $create);
            $stub_name = ["json_genral"];
            $this->json_lang_builder($stub_name);
            $stub_name = ["json_ar_genral"];
            $this->json_lang_builder($stub_name, [], [], 'ar');
            foreach ($table_list as $table) {
                $this->info('craete ' . $table . '  lang translation');
                $plural_TABLE_NAME           = Str::plural($table);
                $singular_TABLE_NAME         = Str::singular($table);
                $ucfirst_singular_TABLE_NAME = ucfirst($singular_TABLE_NAME);
                $ucfirst_plural_TABLE_NAME   = ucfirst($plural_TABLE_NAME);

                $title = Str::headline($ucfirst_plural_TABLE_NAME);

                $stub_name = ["custom_json_value"];
                $replace   = ['{{KEY}}', '{{VALUE}}'];
                $items     = [$title, $title];
                $this->json_lang_builder($stub_name, $replace, $items);
                $this->json_lang_builder($stub_name, $replace, $items, 'ar', 2, $sleep);

                $stub_name = ["json_value"];
                $replace   = ['{{TABLE_NAME}}', '{{COLUMN_NAME}}', '{{translation}}', "{{singular_TABLE_NAME}}"];
                $items     = [$plural_TABLE_NAME, $plural_TABLE_NAME, $ucfirst_plural_TABLE_NAME, $singular_TABLE_NAME];
                $this->json_lang_builder($stub_name, $replace, $items);
                $this->json_lang_builder($stub_name, $replace, $items, 'ar', 2, $sleep);
                $columns = DB::select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$plural_TABLE_NAME'");
                foreach ($columns as $column) {
                    $COLUMN_NAME = $column->COLUMN_NAME;
                    $converted   = Str::studly($COLUMN_NAME);
                    $stub_name   = ["json_value"];
                    $replace     = ['{{TABLE_NAME}}', '{{COLUMN_NAME}}', '{{translation}}'];
                    $items       = [$plural_TABLE_NAME, $COLUMN_NAME, $converted];
                    $this->json_lang_builder($stub_name, $replace, $items);
                    $this->json_lang_builder($stub_name, $replace, $items, 'ar', 2, $sleep);
                }
            }
            $stub_name = ["json_footer"];
            $this->json_lang_builder($stub_name);
            $this->json_lang_builder($stub_name, [], [], 'ar');
        }
        $serve = $this->confirm("RUN  'php artisan serve' Command ?");
        if ($serve) {
            Artisan::call('serve');
        }
    }
}
