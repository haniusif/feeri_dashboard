<?php
namespace App\Console\Commands;

use App;
use App\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class johan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan
    {--all : All things }
    {--table : CRUD for spasific table }
    {--del : Delete All things }
    {--custom : Craete custom path }
    {--api : Craete APIs }
    {--routes : Craete routes }
    {--modules : Craete modules menus }
    {--marge : marge view with other views }
    {--lang : lang file }
    {--flutter : flutter app }
    {--android : android app }
    {--native-android : android app }
    {--ios : ios app }
    {--hello :  hello  }
    {--ckeditor :  use ckeditor with text and longtext  }
    {--doc :  make doc for all functions   }
    ';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'johan command';
    public $app_name       = "FEERI";
    public $skipTables     = [
        'migrations', 'password_resets', 'cache_locks', 'job_batches', 'jobs', 'password_reset_tokens',
        'oauth_access_tokens', 'oauth_auth_codes'
        , 'oauth_clients', 'oauth_personal_access_clients'
        , 'oauth_refresh_tokens', 'failed_jobs'
        , 'personal_access_tokens', 'sessions', 'team_invitations', 'teams'];
    public $appTheams = ['vuexy'];
    public $icons     = [
        'user_id' => 'ti ti-file',
    ];
    public $numericDataTypes = ['INT', 'TINYINT', 'SMALLINT', 'MEDIUMINT', 'BIGINT', 'FLOAT', 'DOUBLE', 'DECIMAL'];
    public $dateandTimeTypes = ['DATE', 'DATETIME', 'TIMESTAMP', 'TIME', 'YEAR'];
    public $stringTypes      = ['CHAR', 'VARCHAR', 'BLOB', 'TEXT', 'TINYBLOB', 'TINYTEXT', 'MEDIUMBLOB', 'MEDIUMTEXT', 'LONGBLOB', 'LONGTEXT', 'ENUM'];
    public $booleanValues    = ['is_active', 'is_cod', 'is_verified', 'owner_image_approved', 'is_coach', 'is_default'];
    public $files            = ['img', 'image', 'file', 'photo', 'logo', 'id_image', 'product_image', 'flag', 'stc_qr', 'coach_diving_licence', 'coach_id_image'];
    public $columnSkeps      = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'remember_token', 'api_token', 'deleted_at'
        , 'email_verified_at'
        , 'two_factor_secret'
        , 'two_factor_recovery_codes'
        , 'firebase_id'
        , 'otp_code'
        , 'sorting'
        , 'otp_expiry_at'
        , 'code', 'profile_photo_path', 'email_verified_at', 'two_factor_secret', 'two_factor_recovery_codes', 'current_team_id', 'two_factor_confirmed_at',
    ];
    public $skipColumns = ['password', 'remember_token', 'api_token', 'deleted_at', 'code', 'profile_photo_path', 'email_verified_at', 'two_factor_secret', 'two_factor_recovery_codes', 'current_team_id', 'two_factor_confirmed_at',
        'id',
        'otp_code',
        'sorting',
        'created_by',
        'updated_by',
        'otp_expiry_at',
    ];
    public $skips       = ['Id', 'id', 'created_by', 'created_at'];
    public $skipId      = ['Id', 'id', 'created_at', 'updated_at', 'last_login', 'last_interactive', 'created_by', 'updated_by', 'is_sign_in', 'login_with', 'last_sign_in', 'last_sig_out'];
    public $skipMdels   = [''];
    public $authColumns = ['created_by', 'updated_by'];
    public $inputs      = ['input', 'select', 'radio', 'checkbox', 'select_checkbox'];
    public $add_choice  = ['yes', 'no', 'custom yes'];
    public function DB_NAME()
    {
        return env('DB_DATABASE');
    }
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
     * @return mixed
     */
    public function handle()
    {
        $lang    = App::getLocale();
        $headers = ['LIST OF TABLEs', 'COUNT OF COLUMS'];
        $DB_NAME = env('DB_DATABASE');
        // $DB_NAME = $this->database_name;
        if ($DB_NAME) {
            $this->info('database name : ' . $DB_NAME);
        } else {
            exit;
        }
        $skip_tables = [
            'migrations', 'password_resets',
            'oauth_access_tokens', 'oauth_auth_codes'
            , 'oauth_clients', 'oauth_personal_access_clients'
            , 'oauth_refresh_tokens', 'failed_jobs'
            , 'personal_access_tokens', 'sessions', 'team_invitations', 'teams'];
        $table_list         = [];
        $table_list_to_show = [];
        $tables             = $this->tables($skip_tables);
        foreach ($tables as $key => $table_value) {
            $column_count         = count($table_value);
            $table_list[]         = $key;
            $table_list_to_show[] = [$key, $column_count];
        }
        $NumericDataTypes = ['INT', 'TINYINT', 'SMALLINT', 'MEDIUMINT', 'BIGINT', 'FLOAT', 'DOUBLE', 'DECIMAL'];
        $DateandTimeTypes = ['DATE', 'DATETIME', 'TIMESTAMP', 'TIME', 'YEAR'];
        $StringTypes      = ['CHAR', 'VARCHAR', 'BLOB', 'TEXT', 'TINYBLOB', 'TINYTEXT', 'MEDIUMBLOB', 'MEDIUMTEXT', 'LONGBLOB', 'LONGTEXT', 'ENUM'];
        $boolean_values   = ['is_active', 'is_cod', 'is_verified', 'owner_image_approved', 'is_coach', 'is_default'];
        $files            = ['img', 'image', 'file', 'photo', 'logo', 'category_image', 'product_image', 'flag', 'stc_qr', 'coach_diving_licence', 'coach_id_image'];
        $column_skeps     = ['Id', 'id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'remember_token', 'api_token', 'deleted_at'];
        $skip_columns     = ['password', 'remember_token', 'api_token', 'deleted_at', 'two_factor_secret', 'two_factor_recovery_codes', 'firebase_id'];
        $skips            = ['Id', 'id', 'created_by', 'created_at'];
        $skip_id          = ['Id', 'id', 'created_at', 'updated_at', 'last_login', 'last_interactive', 'created_by', 'updated_by', 'is_sign_in', 'login_with', 'last_sign_in', 'last_sig_out'];
        $skip_models      = [''];
        $auth_columns     = ['created_by', 'updated_by'];
        $this->table($headers, $table_list_to_show);
        $tabels = $this->tables($skip_tables);
        if ($this->option('modules')) {
            $ModulesCount = Module::count();
            if ($ModulesCount >= 1) {
                if ($this->confirm('Do you wont to delete old modules configrations ?')) {
                    $Modules = Module::all();
                    foreach ($Modules as $Module) {
                        $Module->delete();
                        $this->info('Moduel No.' . $Module->id . ' was deleted successfully');
                    }
                }
            }
            exit;
            $tabels_array_keys = array_keys($tabels);
            $parent_id         = 0;
            foreach ($tabels_array_keys as $key => $table) {
                $module_list_to_show = [];
                $module_names        = [];
                $Modules             = Module::all();
                if (count($Modules) >= 1) {
                    foreach ($Modules as $key => $Module_value) {
                        $module_names[]        = $Module_value->en_name;
                        $module_list_to_show[] = [$Module_value->id, $Module_value->parent_id, $Module_value->en_name];
                    }
                    $headers = ['ID', 'Parent ID', 'Name'];
                    $this->table($headers, $module_list_to_show);
                    if ($this->confirm($table . ' is parent module ?')) {
                        $parent_id = 0;
                    } else {
                        $name = $this->choice(
                            'What is the module name?',
                            $module_names,
                            0
                        );
                        $this->info('Your Answer is ' . $name);
                        $parent_id = Module::whereEnName($name)->first()->id;
                    }
                }
                $Module_name = $table;
                if ($this->confirm('translate ' . $table . '  ?')) {
                    $translate = $this->translate($table);
                    $this->info($translate . ' = ' . $table);
                    $Module_name = $translate;
                }
                // translate($from_lan, $to_lan, $text)
                $Module                = new Module();
                $Module->name          = $Module_name;
                $Module->en_name       = $table;
                $Module->route         = $table;
                $Module->image         = '/images/modules/default.png';
                $Module->icon          = '<i class="feather icon-box"></i>';
                $Module->parent_id     = $parent_id;
                $Module->user_type_ids = '1,2,3,4,5,6,7,8,9,10';
                $Module->is_active     = 1;
                $Module->sorting       = ($key + 1);
                $Module->save();
                $this->info($table . 'was craeteed successfully');
            }
            $this->table(
                ['ID', 'Parent ID', 'Name', 'En Name'],
                Module::all(['id', 'parent_id', 'name', 'en_name'])->toArray()
            );
            $serv = $this->confirm("RUN  'php artisan serv' Command ?");
            if ($serv) {
                Artisan::call('serve');
            }
        } elseif ($this->option('hello')) {
            $whoami = exec('whoami');
            $this->info("hello , " . $whoami);
        } elseif ($this->option('ios')) {
            $whoami = exec('whoami');
            $this->info("hello , " . $whoami);
            //exec('mkdir android');
            // exec('ionic start myApp blank');
            $android_folder = "IOS";
            if (! is_dir(base_path($android_folder))) {
                mkdir(base_path($android_folder), 0755, true);
            }
            $app_name_strtolower = strtolower($this->app_name);
            $ionic               = exec("cd IOS &&  start cmd  /C ionic start " . $app_name_strtolower . " blank");
            //  $ionic =  exec("cd Android &&  start cmd.exe & ionic start ".$app_name_strtolower." blank");
            $this->info($ionic);
        } elseif ($this->option('native-android')) {
            //activites
            $android_folder = "native-android/activites";
            if (! is_dir(base_path($android_folder))) {
                mkdir(base_path($android_folder), 0755, true);
            }
            $android_folder = "native-android/xml";
            if (! is_dir(base_path($android_folder))) {
                mkdir(base_path($android_folder), 0755, true);
            }
            foreach ($table_list as $table) {
                $this->info(' make ' . $table . ' activity and xml file ');
                $plural_TABLE_NAME   = Str::plural($table);
                $singular_TABLE_NAME = Str::singular($table);
                $columns             = DB::select("SELECT COLUMN_NAME , DATA_TYPE  , COLUMN_COMMENT
       FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$plural_TABLE_NAME'");
                foreach ($columns as $column) {
                    $COLUMN_NAME    = $column->COLUMN_NAME;
                    $DATA_TYPE      = $column->DATA_TYPE;
                    $COLUMN_COMMENT = $column->COLUMN_COMMENT;
                    $this->info(' ------------------------- ' . $COLUMN_NAME . ': ' . $DATA_TYPE);
                    $input      = ($DATA_TYPE == 'text' || $DATA_TYPE == 'longtext') ? 'text_view' : 'input';
                    $stub_names = ["$input"];
                    $replace    = ['{{id}}'];
                    $items      = [$COLUMN_NAME];
                    $create     = $this->native_android_builder($stub_names, $table, $replace, $items);
                }
                $create = $this->native_android_activity_builder($stub_names, $table, $replace, $items);
            }
        } elseif ($this->option('flutter')) {
            $this->info('create new flutter app ..');
        } elseif ($this->option('android')) {
            $whoami = exec('whoami');
            $this->info("hello , " . $whoami);
            //exec('mkdir android');
            // exec('ionic start myApp blank');
            $android_folder = "Android";
            if (! is_dir(base_path($android_folder))) {
                mkdir(base_path($android_folder), 0755, true);
            }
            $app_name_strtolower = strtolower($this->app_name);
            $ionic               = exec("cd Android &&  start cmd  /C ionic start " . $app_name_strtolower . " blank");
            //  $ionic =  exec("cd Android &&  start cmd.exe & ionic start ".$app_name_strtolower." blank");
            $this->info($ionic);
        } elseif ($this->option('lang')) {
            $reset = $this->confirm("Do you wont to reset lang translation");
            if ($reset) {
                // resources\lang\en
                $lang_folder      = "resources/lang/en/";
                $json_lang_folder = "resources/lang/";
                if (! is_dir(base_path($lang_folder))) {
                    mkdir(base_path($lang_folder), 0755, true);
                }
                if (! is_dir(base_path($json_lang_folder))) {
                    mkdir(base_path($json_lang_folder), 0755, true);
                }
                $phrase = "/stubs/make/lang/messages_header.stub";
                $create = $this->create($phrase);
                file_put_contents($lang_folder . "messages.php", $create);
                $phrase = "/stubs/make/lang/json_header.stub";
                $create = $this->create($phrase);
                file_put_contents($json_lang_folder . "ar.json", $create);
                file_put_contents($json_lang_folder . "en.json", $create);
                $stub_name = ["messages_genral"];
                $this->lang_builder($stub_name);
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
                    $stub_name                   = ["messages_comment", "messages_value", "messages_opt"];
                    $replace                     = ['{{TABLE_NAME}}', '{{COLUMN_NAME}}', '{{translation}}', "{{singular_TABLE_NAME}}"];
                    $items                       = [$plural_TABLE_NAME, $plural_TABLE_NAME, $ucfirst_plural_TABLE_NAME, $singular_TABLE_NAME];
                    $this->lang_builder($stub_name, $replace, $items);
                    $stub_name = ["json_value"];
                    $replace   = ['{{TABLE_NAME}}', '{{COLUMN_NAME}}', '{{translation}}', "{{singular_TABLE_NAME}}"];
                    $items     = [$plural_TABLE_NAME, $plural_TABLE_NAME, $ucfirst_plural_TABLE_NAME, $singular_TABLE_NAME];
                    $this->json_lang_builder($stub_name, $replace, $items);
                    $this->json_lang_builder($stub_name, $replace, $items, 'ar', 2);
                    $columns = DB::select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
       FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$plural_TABLE_NAME'");
                    foreach ($columns as $column) {
                        $COLUMN_NAME = $column->COLUMN_NAME;
                        $converted   = Str::studly($COLUMN_NAME);
                        $stub_name   = ["messages_value"];
                        $replace     = ['{{TABLE_NAME}}', '{{COLUMN_NAME}}', '{{translation}}'];
                        $items       = [$plural_TABLE_NAME, $COLUMN_NAME, $converted];
                        $this->lang_builder($stub_name, $replace, $items);
                        $stub_name = ["json_value"];
                        $replace   = ['{{TABLE_NAME}}', '{{COLUMN_NAME}}', '{{translation}}'];
                        $items     = [$plural_TABLE_NAME, $COLUMN_NAME, $converted];
                        $this->json_lang_builder($stub_name, $replace, $items);
                        $this->json_lang_builder($stub_name, $replace, $items, 'ar', 2);
                    }
                }
                $stub_name = ["messages_footer"];
                $this->lang_builder($stub_name);
                $stub_name = ["json_footer"];
                $this->json_lang_builder($stub_name);
                $this->json_lang_builder($stub_name, [], [], 'ar');
            }
            $serv = $this->confirm("RUN  'php artisan serv' Command ?");
            if ($serv) {
                Artisan::call('serve');
            }
        } elseif ($this->option('api')) {
            $Controllers_folder = app_path("Http/Controllers/API/");
            if (! file_exists($Controllers_folder)) {
                mkdir($Controllers_folder, 0777);
            }
            $APP_URL = env('APP_URL');
            $phrase  = "/stubs/make/api/api_controller.stub";
            $replace = ['{{APPURL}}'];
            $items   = [$APP_URL];
            $create  = $this->create($phrase, $replace, $items);
            file_put_contents($Controllers_folder . "APIController.php", $create);
            $apps = 'apps';
            foreach ($table_list as $table) {
                $this->info('craete ' . $table . '  API route');
                $plural_TABLE_NAME           = Str::plural($table);
                $singular_TABLE_NAME         = Str::singular($table);
                $ucfirst_singular_TABLE_NAME = ucfirst($singular_TABLE_NAME);
                $ucfirst_plural_TABLE_NAME   = ucfirst($plural_TABLE_NAME);
                $phrase                      = "/stubs/make/api/routes.stub";
                $replace                     = ['{{names}}', '{{name}}', '{{controller_name}}'];
                $items                       = [$plural_TABLE_NAME, $singular_TABLE_NAME, $ucfirst_singular_TABLE_NAME];
                $compileRoute                = $this->compileRoute($phrase, $replace, $items);
                file_put_contents(base_path('routes/api.php'), $compileRoute, FILE_APPEND);
                if ($table == 'users') {
                    $apps = 'apps_user';
                }
                $stub_name = ['names' => ["controller_header", "$apps", "controller_name"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{name}}', '{{app_name}}', '{{controller_name}}'];
                $items     = [$ucfirst_singular_TABLE_NAME, $this->app_name, $ucfirst_singular_TABLE_NAME];
                $this->api_builder($stub_name, $replace, $items);
                if ($table == 'users') {
                    if ($this->confirm('have auth ?')) {
                        $auths     = ['phone', 'email', 'username', 'OTP'];
                        $auth_type = $this->ask('What is auth type [phone|email|username|OTP] ?');
                        if (in_array($auth_type, $auths)) {
                            $this->info('auth with ' . $auth_type . ' will be created');
                            $phrase       = ($auth_type != "OTP") ? "/stubs/make/api/auth.stub" : "/stubs/make/api/otp.stub";
                            $compileRoute = $this->compileRoute($phrase);
                            file_put_contents(base_path('routes/api.php'), $compileRoute, FILE_APPEND);
                            $stub_name = ['names' => ["auth_$auth_type"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $this->api_builder($stub_name);
                        } else {
                            $this->info('invalid auth ');
                        }
                    }
                }
                $columns = DB::select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
       FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$plural_TABLE_NAME'");
                $constrints = DB::select("select COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME
       from information_schema.KEY_COLUMN_USAGE
       where TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$plural_TABLE_NAME'");
                $constrints_array = [];
                foreach ($constrints as $constrint) {
                    $COLUMN_NAME            = $constrint->COLUMN_NAME;
                    $CONSTRAINT_NAME        = $constrint->CONSTRAINT_NAME;
                    $REFERENCED_COLUMN_NAME = $constrint->REFERENCED_COLUMN_NAME;
                    $REFERENCED_TABLE_NAME  = $constrint->REFERENCED_TABLE_NAME;
                    $this->info('-------' . $COLUMN_NAME . " : " . $CONSTRAINT_NAME . " : " . $REFERENCED_COLUMN_NAME . " : " . $REFERENCED_TABLE_NAME);
                    if (! empty($REFERENCED_TABLE_NAME)) {
                        $constrints_array[$plural_TABLE_NAME][$COLUMN_NAME] = [
                            'REFERENCED_COLUMN_NAME' => $REFERENCED_COLUMN_NAME,
                            'REFERENCED_TABLE_NAME'  => $REFERENCED_TABLE_NAME,
                        ];
                    }
                }
                $stub_name = ['names' => ["controller_function"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{names}}', '{{UC_name}}', '{{lang}}'];
                $items     = [$plural_TABLE_NAME, $ucfirst_singular_TABLE_NAME, $lang];
                $this->api_builder($stub_name, $replace, $items);
                $stub_name = ['names' => ["controller_function_end"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $this->api_builder($stub_name);
                $stub_name = ['names' => ["controller_function_show"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{name}}', '{{parm_id}}', '{{names}}', '{{UC_name}}', '{{lang}}'];
                $items     = [$singular_TABLE_NAME, $singular_TABLE_NAME . "_id", $plural_TABLE_NAME, $ucfirst_singular_TABLE_NAME, $lang];
                $this->api_builder($stub_name, $replace, $items);
                $stub_name = ['names' => ["controller_function_end"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $this->api_builder($stub_name);
                $stub_name = ['names' => ["controller_function_add"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{name}}', '{{parm_id}}', '{{names}}', '{{UC_name}}', '{{lang}}'];
                $items     = [$singular_TABLE_NAME, $singular_TABLE_NAME . "_id", $plural_TABLE_NAME, $ucfirst_singular_TABLE_NAME, $lang];
                $this->api_builder($stub_name, $replace, $items);
                $stub_name = ['names' => ["validate_input_start"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $this->api_builder($stub_name);
                krsort($columns);
                foreach ($columns as $column) {
                    $COLUMN_NAME = $column->COLUMN_NAME;
                    $DATA_TYPE   = $column->DATA_TYPE;
                    $models      = (isset($constrints_array[$plural_TABLE_NAME][$COLUMN_NAME])) ? $constrints_array[$plural_TABLE_NAME][$COLUMN_NAME] : false;
                    if (in_array($COLUMN_NAME, $auth_columns)) {
                        if ($models) {
                            $REF_COL_NAME = $models['REFERENCED_COLUMN_NAME'];
                            $REF_TBL_NAME = $models['REFERENCED_TABLE_NAME'];
                            $stub_name    = ['names' => ["validate_input_full"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace      = ['{{input}}', '{{REF_TBL_NAME}}', '{{REF_COL_NAME}}'];
                            $items        = [$COLUMN_NAME, $REF_TBL_NAME, $REF_COL_NAME];
                            $this->api_builder($stub_name, $replace, $items);
                        } else {
                            $stub_name = ['names' => ["validate_auth_input"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace   = ['{{input}}'];
                            $items     = [$COLUMN_NAME];
                            $this->api_builder($stub_name, $replace, $items);
                        }
                    }
                    //  if(!in_array($COLUMN_NAME , $column_skeps)){
                    if (! in_array($COLUMN_NAME, $skip_id) && ! in_array($COLUMN_NAME, $skip_columns)) {
                        if ($models) {
                            $REF_COL_NAME = $models['REFERENCED_COLUMN_NAME'];
                            $REF_TBL_NAME = $models['REFERENCED_TABLE_NAME'];
                            $stub_name    = ['names' => ["validate_input_full"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace      = ['{{input}}', '{{REF_TBL_NAME}}', '{{REF_COL_NAME}}'];
                            $items        = [$COLUMN_NAME, $REF_TBL_NAME, $REF_COL_NAME];
                            $this->api_builder($stub_name, $replace, $items);
                        } else {
                            $stub_name = ['names' => ["validate_input"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace   = ['{{input}}'];
                            $items     = [$COLUMN_NAME];
                            $this->api_builder($stub_name, $replace, $items);
                        }
                        //           if(!in_array($COLUMN_NAME , $skip_id ) && !in_array($COLUMN_NAME,$boolean_values)){
                        //  }
                    }
                }
                $stub_name = ['names' => ["validate_input_end"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{name}}', '{{UC_name}}'];
                $items     = [$singular_TABLE_NAME, $ucfirst_singular_TABLE_NAME];
                $this->api_builder($stub_name, $replace, $items);
                foreach ($columns as $column) {
                    $COLUMN_NAME = $column->COLUMN_NAME;
                    $DATA_TYPE   = $column->DATA_TYPE;
                    if (in_array($COLUMN_NAME, $auth_columns)) {
                        $stub_name = ['names' => ["input_auth"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_TABLE_NAME, $COLUMN_NAME];
                        $this->api_builder($stub_name, $replace, $items);
                    }
                    if (! in_array($COLUMN_NAME, $skip_id) && ! in_array($COLUMN_NAME, $skip_columns)) {
                        // create
                        $stub_name = ['names' => ["input"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_TABLE_NAME, $COLUMN_NAME];
                        if (in_array($COLUMN_NAME, $files)) {
                            $stub_name = ['names' => ["input_file"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace   = ['{{names}}', '{{name}}', '{{input}}'];
                            $items     = [$plural_TABLE_NAME, $singular_TABLE_NAME, $COLUMN_NAME];
                        } elseif (in_array($COLUMN_NAME, $boolean_values)) {
                            $stub_name = ['names' => ["input_boolean"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace   = ['{{name}}', '{{input}}'];
                            $items     = [$singular_TABLE_NAME, $COLUMN_NAME];
                        } elseif ($COLUMN_NAME == "password") {
                            $stub_name = ['names' => ["input_password"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace   = ['{{name}}', '{{input}}'];
                            $items     = [$singular_TABLE_NAME, $COLUMN_NAME];
                        }
                        $this->api_builder($stub_name, $replace, $items);
                    }
                }
                //
                $stub_name = ['names' => ["controller_function_add_end"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{name}}'];
                $items     = [$singular_TABLE_NAME];
                $this->api_builder($stub_name, $replace, $items);
                /////// update /////
                $stub_name = ['names' => ["controller_function_update"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{name}}', '{{parm_id}}', '{{names}}', '{{UC_name}}', '{{lang}}'];
                $items     = [$singular_TABLE_NAME, $singular_TABLE_NAME . "_id", $plural_TABLE_NAME, $ucfirst_singular_TABLE_NAME, $lang];
                $this->api_builder($stub_name, $replace, $items);
                $stub_name = ['names' => ["validate_input_update_start"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{parm_id}}', '{{names}}'];
                $items     = [$singular_TABLE_NAME . "_id", $plural_TABLE_NAME];
                $this->api_builder($stub_name, $replace, $items);
                krsort($columns);
                foreach ($columns as $column) {
                    $COLUMN_NAME = $column->COLUMN_NAME;
                    $DATA_TYPE   = $column->DATA_TYPE;
                    $models      = (isset($constrints_array[$plural_TABLE_NAME][$COLUMN_NAME])) ? $constrints_array[$plural_TABLE_NAME][$COLUMN_NAME] : false;
                    if ($models) {
                        if (in_array($COLUMN_NAME, $auth_columns) && $COLUMN_NAME != 'created_by') {
                            $REF_COL_NAME = $models['REFERENCED_COLUMN_NAME'];
                            $REF_TBL_NAME = $models['REFERENCED_TABLE_NAME'];
                            $stub_name    = ['names' => ["validate_input_update_full"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace      = ['{{input}}', '{{REF_TBL_NAME}}', '{{REF_COL_NAME}}'];
                            $items        = [$COLUMN_NAME, $REF_TBL_NAME, $REF_COL_NAME];
                            $this->api_builder($stub_name, $replace, $items);
                        }
                        if (! in_array($COLUMN_NAME, $skip_id) && ! in_array($COLUMN_NAME, $skip_columns)) {
                            $REF_COL_NAME = $models['REFERENCED_COLUMN_NAME'];
                            $REF_TBL_NAME = $models['REFERENCED_TABLE_NAME'];
                            $stub_name    = ['names' => ["validate_input_update_full"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace      = ['{{input}}', '{{REF_TBL_NAME}}', '{{REF_COL_NAME}}'];
                            $items        = [$COLUMN_NAME, $REF_TBL_NAME, $REF_COL_NAME];
                            $this->api_builder($stub_name, $replace, $items);
                        }
                    }
                }
                $stub_name = ['names' => ["validate_input_update_end"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{name}}', '{{UC_name}}', '{{parm_id}}'];
                $items     = [$singular_TABLE_NAME, $ucfirst_singular_TABLE_NAME, $singular_TABLE_NAME . "_id"];
                $this->api_builder($stub_name, $replace, $items);
                foreach ($columns as $column) {
                    $COLUMN_NAME = $column->COLUMN_NAME;
                    $DATA_TYPE   = $column->DATA_TYPE;
                    if (in_array($COLUMN_NAME, $auth_columns) && $COLUMN_NAME != 'created_by') {
                        $stub_name = ['names' => ["input_auth_update"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_TABLE_NAME, $COLUMN_NAME];
                        $this->api_builder($stub_name, $replace, $items);
                    }
                    if (! in_array($COLUMN_NAME, $skip_id) && ! in_array($COLUMN_NAME, $skip_columns)) {
                        $stub_name = ['names' => ["input_update"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_TABLE_NAME, $COLUMN_NAME];
                        if (in_array($COLUMN_NAME, $files)) {
                            $stub_name = ['names' => ["input_file_update"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace   = ['{{names}}', '{{name}}', '{{input}}'];
                            $items     = [$plural_TABLE_NAME, $singular_TABLE_NAME, $COLUMN_NAME];
                        } elseif (in_array($COLUMN_NAME, $boolean_values)) {
                            $stub_name = ['names' => ["input_boolean_update"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace   = ['{{name}}', '{{input}}'];
                            $items     = [$singular_TABLE_NAME, $COLUMN_NAME];
                        } elseif ($COLUMN_NAME == "password") {
                            $stub_name = ['names' => ["input_password_update"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                            $replace   = ['{{name}}', '{{input}}'];
                            $items     = [$singular_TABLE_NAME, $COLUMN_NAME];
                        }
                        $this->api_builder($stub_name, $replace, $items);
                    }
                }
                $stub_name = ['names' => ["controller_function_update_end"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{name}}', '{{names}}'];
                $items     = [$singular_TABLE_NAME, $plural_TABLE_NAME];
                $this->api_builder($stub_name, $replace, $items);
                $stub_name = ['names' => ["controller_function_delete"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $replace   = ['{{name}}', '{{parm_id}}', '{{names}}', '{{UC_name}}', '{{lang}}'];
                $items     = [$singular_TABLE_NAME, $singular_TABLE_NAME . "_id", $plural_TABLE_NAME, $ucfirst_singular_TABLE_NAME, $lang];
                $this->api_builder($stub_name, $replace, $items);
                $stub_name = ['names' => ["controller_function_end"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $this->api_builder($stub_name);
                $stub_name = ['names' => ["controller_footer"], 'controller_name' => $ucfirst_singular_TABLE_NAME];
                $this->api_builder($stub_name);
            }
            $serv = $this->confirm("RUN  'php artisan serv' Command ?");
            if ($serv) {
                Artisan::call('serve');
            }
        } elseif ($this->option('del')) {
            $apps_folder        = app_path($this->app_name . "/");
            $Controllers_folder = app_path("Http/Controllers/" . $this->app_name . "/");
            $resources_folder   = "resources/views/" . $this->app_name . "/";
            $folders            = [$Controllers_folder, $resources_folder, $apps_folder];
            foreach ($folders as $dir) {
                $confirmToDlete = $this->confirm("Delete every things in $dir ?");
                if ($confirmToDlete) {
                    $this->deletedir($dir);
                }
            }
        } elseif ($this->option('marge')) {
            $theamName = $this->choice(
                'Select theam',
                $this->appTheams,
                0
            );
            $this->info($theamName);
            $master = $this->ask('select master view');
            if (in_array($master, $table_list)) {
                $plural_master_model_name           = Str::plural($master);
                $singular_master_model_name         = Str::singular($master);
                $ucfirst_singular_master_model_name = ucfirst($singular_master_model_name);
                $ucfirst_plural_master_model_name   = ucfirst($plural_master_model_name);
                $stub_names                         = [
                    $singular_master_model_name . "_master_add" => 'create_header'
                    , $singular_master_model_name . "_master_view" => 'show_header',
                ];
                $replace = ['{{name}}', '{{names}}'];
                $items   = [$singular_master_model_name, $plural_master_model_name];
                $this->view_builder($stub_names, $replace, $items, $plural_master_model_name, $theamName);
                foreach ($table_list as $model_name) {
                    $plural_model_name           = Str::plural($model_name);
                    $singular_model_name         = Str::singular($model_name);
                    $ucfirst_singular_model_name = ucfirst($singular_model_name);
                    $ucfirst_plural_model_name   = ucfirst($plural_model_name);
                    if ($this->confirm('marge with ' . $plural_model_name . ' ? ')) {
                        $this->info("" . $plural_model_name . ":" . $ucfirst_plural_model_name . ":" . $singular_model_name . "" . $ucfirst_singular_model_name);
                        $columns = DB::select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
       FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$plural_model_name'");
                        foreach ($columns as $column) {
                            $COLUMN_NAME    = $column->COLUMN_NAME;
                            $DATA_TYPE      = $column->DATA_TYPE;
                            $COLUMN_COMMENT = $column->COLUMN_COMMENT;
                            $this->info('COLUMN_NAME : ' . $COLUMN_NAME . '| COLUMN_COMMENT : ' . $COLUMN_COMMENT);
                        }
                    }
                }
                $stub_names = [
                    $singular_master_model_name . "_master_add"  => 'create_footer',
                    //   , $singular_model_name."_master_edit" => 'edit_footer'
                    $singular_master_model_name . "_master_view" => 'show_footer',
                ];
                $replace = ['{{name}}', '{{names}}'];
                $items   = [$singular_master_model_name, $plural_master_model_name];
                $this->view_builder($stub_names, $replace, $items, $plural_master_model_name, $theamName);
            } else {
                $this->info($master . ' not in table list');
            }
        } elseif ($this->option('table')) {
            $theamName = $this->choice(
                'Select theam',
                $this->appTheams,
                0
            );
            $this->info($theamName);
            $model_name                  = $this->ask('what is the model name ? ');
            $plural_model_name           = Str::plural($model_name);
            $singular_model_name         = Str::singular($model_name);
            $ucfirst_singular_model_name = ucfirst($singular_model_name);
            $ucfirst_plural_model_name   = ucfirst($plural_model_name);
            $this->info("" . $plural_model_name . ":" . $ucfirst_plural_model_name . ":" . $singular_model_name . "" . $ucfirst_singular_model_name);
            // if(!in_array()){
            $exitCode = Artisan::call('make:model', ['name' => $this->app_name . '/' . $ucfirst_singular_model_name]);
            // }
            $this->createDirectories($plural_model_name);
            // make controllers dir
            $Controllers_folder = app_path("Http/Controllers/" . $this->app_name . "/");
            if (! file_exists($Controllers_folder)) {
                mkdir($Controllers_folder, 0777);
            }
            // end
            // create
            $phrase  = "/stubs/make/controllers/header.stub";
            $replace = ['{{name}}', '{{app_name}}'];
            $items   = [$ucfirst_singular_model_name, $this->app_name];
            $create  = $this->create($phrase, $replace, $items);
            file_put_contents($Controllers_folder . $ucfirst_singular_model_name . "Controller.php", $create);
            $columns = DB::select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
       FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$plural_model_name'");
            $constrints = DB::select("select COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME
       from information_schema.KEY_COLUMN_USAGE
       where TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$plural_model_name'");
            $constrints_array         = [];
            $constrints_tables_name   = [];
            $constrints_tables_remote = [];
            foreach ($constrints as $constrint) {
                $COLUMN_NAME            = $constrint->COLUMN_NAME;
                $CONSTRAINT_NAME        = $constrint->CONSTRAINT_NAME;
                $REFERENCED_COLUMN_NAME = $constrint->REFERENCED_COLUMN_NAME;
                $REFERENCED_TABLE_NAME  = $constrint->REFERENCED_TABLE_NAME;
                $this->info('-------' . $COLUMN_NAME . " : " . $CONSTRAINT_NAME . " : " . $REFERENCED_COLUMN_NAME . " : " . $REFERENCED_TABLE_NAME);
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
            $constrints_tables_name_unique = array_unique($constrints_tables_name);
            foreach ($constrints_tables_name_unique as $constrints_table_name) {
                $constrints_table_name_singular         = Str::singular($constrints_table_name);
                $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                // create
                if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                    $stub_name = ["apps"];
                    $replace   = ['{{name}}', '{{app_name}}'];
                    $items     = [$ucfirst_constrints_table_name_singular, $this->app_name];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                    // create
                }
            }
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
            $replace = ['{{name}}', '{{names}}'];
            $items   = [$singular_model_name, $plural_model_name];
            $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
            // create | Update | show
            foreach ($columns as $column) {
                $COLUMN_NAME    = $column->COLUMN_NAME;
                $DATA_TYPE      = $column->DATA_TYPE;
                $COLUMN_COMMENT = $column->COLUMN_COMMENT;
                $this->info('COLUMN_NAME : ' . $COLUMN_NAME . '| COLUMN_COMMENT : ' . $COLUMN_COMMENT);
                // if ($this->confirm('Add this ?'.$COLUMN_NAME)) {
                if (! in_array($COLUMN_NAME, $skip_columns)) {
                    $models = (isset($constrints_array[$plural_model_name][$COLUMN_NAME])) ? $constrints_array[$plural_model_name][$COLUMN_NAME] : false;
                    if (! in_array($COLUMN_NAME, $skip_id)) {
                        if ($models && Str::endsWith($COLUMN_NAME, '_id') && ! Str::endsWith($COLUMN_NAME, '_ids')) {
                            $this->info("------------------------------------------------------" . $COLUMN_NAME);
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
                            $items   = [$models['prtn'], $models['srtn'], $COLUMN_NAME, $singular_model_name, $plural_model_name, $this->main_colum_name($models['prtn'])];
                            $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                        } elseif (Str::endsWith($COLUMN_NAME, '_ids')) {
                            $this->info("------------------------------------------------------" . $COLUMN_NAME);
                            $substr = substr($COLUMN_NAME, 0, -4);
                            // $str_replace = str_replace($COLUMN_NAME,"_ids","");
                            $substr_plural           = Str::plural($substr);
                            $substr_singular         = Str::singular($substr);
                            $substr_ucfirst_singular = ucfirst($substr_singular);
                            $substr_ucfirst_plural   = ucfirst($substr_plural);
                            $this->info($substr);
                        } else {
                            $textarea      = ($this->option('ckeditor')) ? 'ckeditor_textarea' : 'textarea';
                            $show_textarea = ($this->option('ckeditor')) ? 'ckeditor_show_textarea' : 'show_textarea';
                            $input         = ($DATA_TYPE == 'text' || $DATA_TYPE == 'longtext') ? $textarea : "input";
                            $show_input    = ($DATA_TYPE == 'text' || $DATA_TYPE == 'longtext') ? $show_textarea : "show_input";
                            if (in_array($COLUMN_NAME, $files)) {
                                $input      = "input_file";
                                $show_input = "show_input_file";
                            } elseif (in_array($COLUMN_NAME, $boolean_values) && ! in_array($DATA_TYPE, $NumericDataTypes)) { //      is_active | tinyint(1)
                                $input      = "input_boolean";
                                $show_input = "show_input_boolan";
                            }
                            $type = "text";
                            if (in_array(strtoupper($DATA_TYPE), $NumericDataTypes) && ! in_array($COLUMN_NAME, $boolean_values)) {
                                $type = "number";
                            }
                            if (in_array(strtoupper($DATA_TYPE), $DateandTimeTypes) && ! in_array($COLUMN_NAME, $boolean_values)) {
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
                            $items   = [$singular_model_name, $plural_model_name, $COLUMN_NAME, $type];
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
                $DATA_TYPE   = $column->DATA_TYPE;
                if (! in_array($COLUMN_NAME, $skip_columns)) {
                    $stub_names = [
                        $plural_model_name => 'th_column',
                    ];
                    $replace = ['{{colum_name}}', '{{names}}'];
                    $items   = [$COLUMN_NAME, $plural_model_name];
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
            $items   = [$singular_model_name, $plural_model_name];
            $this->view_builder($stub_names, $replace, $items, $plural_model_name);
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE   = $column->DATA_TYPE;
                if (! in_array($COLUMN_NAME, $skip_columns)) {
                    $stub_names = [
                        //  $singular_model_name."_add" => 'create_header'
                        // ,
                        $plural_model_name => 'th_column',
                        //  , $singular_model_name."_edit" => 'edit_header'
                        //  , $singular_model_name."_view" => 'show_header'
                    ];
                    $replace = ['{{name}}', '{{colum_name}}', '{{names}}'];
                    $items   = [$singular_model_name, $COLUMN_NAME, $plural_model_name];
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
            $items   = [$singular_model_name, $plural_model_name];
            $this->view_builder($stub_names, $replace, $items, $plural_model_name);
            /// data for script
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE   = $column->DATA_TYPE;
                if (! in_array($COLUMN_NAME, $skip_columns)) {
                    $stub_names = [
                        $plural_model_name => 'script_data',
                    ];
                    $replace = ['{{colum_name}}'];
                    $items   = [$COLUMN_NAME];
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
            $items   = [$singular_model_name, $plural_model_name];
            $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
            $create_footer = ($this->option('ckeditor')) ? 'ckeditor_create_footer' : 'create_footer';
            $show_footer   = ($this->option('ckeditor')) ? 'ckeditor_show_footer' : 'show_footer';
            $stub_names    = [
                $singular_model_name . "_add" => $create_footer
                , $plural_model_name => 'index_footer'
                , $singular_model_name . "_edit" => 'edit_footer'
                , $singular_model_name . "_view" => $show_footer,
            ];
            if ($singular_model_name == 'user') {
                $stub_names['my_profile'] = 'my_profile_footer';
            }
            $replace = ['{{name}}', '{{names}}'];
            $items   = [$singular_model_name, $plural_model_name];
            $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
            // views
            // create
            $stub_name = ["class_name", "index"];
            $replace   = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
            $items     = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
            $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
            // create
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
                    $items                  = [$REFERENCED_TABLE_NAME, Str::singular($REFERENCED_TABLE_NAME), $REFERENCED_COLUMN_NAME, $this->main_colum_name($REFERENCED_TABLE_NAME)];
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
            // create
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
            krsort($columns);
            foreach ($columns as $column) {
                $COLUMN_NAME = $column->COLUMN_NAME;
                $DATA_TYPE   = $column->DATA_TYPE;
                if (! in_array($COLUMN_NAME, $column_skeps)) {
                    if (! in_array($COLUMN_NAME, $skip_id) && ! in_array($COLUMN_NAME, $boolean_values)) {
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
                if (in_array($COLUMN_NAME, $auth_columns)) {
                    $stub_name = ["input_auth"];
                    $replace   = ['{{name}}', '{{input}}'];
                    $items     = [$singular_model_name, $COLUMN_NAME];
                    $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                }
                if (! in_array($COLUMN_NAME, $skip_id) && ! in_array($COLUMN_NAME, $skip_columns)) {
                    // create
                    $stub_name = ["input"];
                    $replace   = ['{{name}}', '{{input}}'];
                    $items     = [$singular_model_name, $COLUMN_NAME];
                    if (in_array($COLUMN_NAME, $files)) {
                        $stub_name = ["input_file"];
                        $replace   = ['{{names}}', '{{name}}', '{{input}}'];
                        $items     = [$plural_model_name, $singular_model_name, $COLUMN_NAME];
                    } elseif (in_array($COLUMN_NAME, $boolean_values)) {
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
                if (! in_array($COLUMN_NAME, $skip_id) && ! in_array($COLUMN_NAME, $skip_columns)) {
                    // create
                    $stub_name = ["input"];
                    $replace   = ['{{name}}', '{{input}}'];
                    $items     = [$singular_model_name, $COLUMN_NAME];
                    if (in_array($COLUMN_NAME, $files)) {
                        $stub_name = ["input_file"];
                        $replace   = ['{{names}}', '{{name}}', '{{input}}'];
                        $items     = [$plural_model_name, $singular_model_name, $COLUMN_NAME];
                    } elseif (in_array($COLUMN_NAME, $boolean_values)) {
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
            $serv = $this->confirm("RUN  'php artisan serv' Command ?");
            if ($serv) {
                Artisan::call('serve');
            }
        } elseif ($this->option('all')) {
            $theamName = $this->choice(
                'Select theam',
                $this->appTheams,
                0
            );
            $this->info($theamName);
            foreach ($table_list as $model_name) {
                $plural_model_name           = Str::plural($model_name);
                $singular_model_name         = Str::singular($model_name);
                $ucfirst_singular_model_name = ucfirst($singular_model_name);
                $ucfirst_plural_model_name   = ucfirst($plural_model_name);
                $this->info("" . $plural_model_name . ":" . $ucfirst_plural_model_name . ":" . $singular_model_name . "" . $ucfirst_singular_model_name);
                // if(!in_array()){
                $exitCode = Artisan::call('make:model', ['name' => $this->app_name . '/' . $ucfirst_singular_model_name]);
                // }
                $this->createDirectories($plural_model_name);
                // make controllers dir
                $Controllers_folder = app_path("Http/Controllers/" . $this->app_name . "/");
                if (! file_exists($Controllers_folder)) {
                    mkdir($Controllers_folder, 0777);
                }
                // end
                // create
                $phrase  = "/stubs/make/controllers/header.stub";
                $replace = ['{{name}}', '{{app_name}}'];
                $items   = [$ucfirst_singular_model_name, $this->app_name];
                $create  = $this->create($phrase, $replace, $items);
                file_put_contents($Controllers_folder . $ucfirst_singular_model_name . "Controller.php", $create);
                // n create
                $columns = DB::select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
       FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$plural_model_name'");
                $constrints = DB::select("select COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME
       from information_schema.KEY_COLUMN_USAGE
       where TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$plural_model_name'");
                $constrints_array         = [];
                $constrints_tables_name   = [];
                $constrints_tables_remote = [];
                foreach ($constrints as $constrint) {
                    $COLUMN_NAME            = $constrint->COLUMN_NAME;
                    $CONSTRAINT_NAME        = $constrint->CONSTRAINT_NAME;
                    $REFERENCED_COLUMN_NAME = $constrint->REFERENCED_COLUMN_NAME;
                    $REFERENCED_TABLE_NAME  = $constrint->REFERENCED_TABLE_NAME;
                    $this->info('-------' . $COLUMN_NAME . " : " . $CONSTRAINT_NAME . " : " . $REFERENCED_COLUMN_NAME . " : " . $REFERENCED_TABLE_NAME);
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
                $constrints_tables_name_unique = array_unique($constrints_tables_name);
                foreach ($constrints_tables_name_unique as $constrints_table_name) {
                    $constrints_table_name_singular         = Str::singular($constrints_table_name);
                    $ucfirst_constrints_table_name_singular = ucfirst($constrints_table_name_singular);
                    // create
                    if ($ucfirst_constrints_table_name_singular != $ucfirst_singular_model_name) {
                        $stub_name = ["apps"];
                        $replace   = ['{{name}}', '{{app_name}}'];
                        $items     = [$ucfirst_constrints_table_name_singular, $this->app_name];
                        $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                        // create
                    }
                }
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
                $replace = ['{{name}}', '{{names}}'];
                $items   = [$singular_model_name, $plural_model_name];
                $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                // create | Update | show
                foreach ($columns as $column) {
                    $COLUMN_NAME    = $column->COLUMN_NAME;
                    $DATA_TYPE      = $column->DATA_TYPE;
                    $COLUMN_COMMENT = $column->COLUMN_COMMENT;
                    $this->info('COLUMN_NAME : ' . $COLUMN_NAME . '| COLUMN_COMMENT : ' . $COLUMN_COMMENT);
                    // if ($this->confirm('Add this ?'.$COLUMN_NAME)) {
                    if (! in_array($COLUMN_NAME, $skip_columns)) {
                        $models = (isset($constrints_array[$plural_model_name][$COLUMN_NAME])) ? $constrints_array[$plural_model_name][$COLUMN_NAME] : false;
                        if (! in_array($COLUMN_NAME, $skip_id)) {
                            if ($models && Str::endsWith($COLUMN_NAME, '_id')) {
                                $this->info("------------------------------------------------------" . $COLUMN_NAME);
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
                                $items   = [$models['prtn'], $models['srtn'], $COLUMN_NAME, $singular_model_name, $plural_model_name, $this->main_colum_name($models['prtn'])];
                                $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                            } else {
                                $textarea      = ($this->option('ckeditor')) ? 'ckeditor_textarea' : 'textarea';
                                $show_textarea = ($this->option('ckeditor')) ? 'ckeditor_show_textarea' : 'show_textarea';
                                $input         = ($DATA_TYPE == 'text' || $DATA_TYPE == 'longtext') ? $textarea : "input";
                                $show_input    = ($DATA_TYPE == 'text' || $DATA_TYPE == 'longtext') ? $show_textarea : "show_input";
                                if (in_array($COLUMN_NAME, $files)) {
                                    $input      = "input_file";
                                    $show_input = "show_input_file";
                                } elseif (in_array($COLUMN_NAME, $boolean_values) && ! in_array($DATA_TYPE, $NumericDataTypes)) { //      is_active | tinyint(1)
                                    $input      = "input_boolean";
                                    $show_input = "show_input_boolan";
                                }
                                $type = "text";
                                if (in_array(strtoupper($DATA_TYPE), $NumericDataTypes) && ! in_array($COLUMN_NAME, $boolean_values)) {
                                    $type = "number";
                                }
                                if (in_array(strtoupper($DATA_TYPE), $DateandTimeTypes) && ! in_array($COLUMN_NAME, $boolean_values)) {
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
                                $items   = [$singular_model_name, $plural_model_name, $COLUMN_NAME, $type];
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
                    $DATA_TYPE   = $column->DATA_TYPE;
                    if (! in_array($COLUMN_NAME, $skip_columns)) {
                        $stub_names = [
                            $plural_model_name => 'th_column',
                        ];
                        $replace = ['{{colum_name}}', '{{names}}'];
                        $items   = [$COLUMN_NAME, $plural_model_name];
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
                $items   = [$singular_model_name, $plural_model_name];
                $this->view_builder($stub_names, $replace, $items, $plural_model_name);
                foreach ($columns as $column) {
                    $COLUMN_NAME = $column->COLUMN_NAME;
                    $DATA_TYPE   = $column->DATA_TYPE;
                    if (! in_array($COLUMN_NAME, $skip_columns)) {
                        $stub_names = [
                            //  $singular_model_name."_add" => 'create_header'
                            // ,
                            $plural_model_name => 'th_column',
                            //  , $singular_model_name."_edit" => 'edit_header'
                            //  , $singular_model_name."_view" => 'show_header'
                        ];
                        $replace = ['{{name}}', '{{colum_name}}', '{{names}}'];
                        $items   = [$singular_model_name, $COLUMN_NAME, $plural_model_name];
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
                $items   = [$singular_model_name, $plural_model_name];
                $this->view_builder($stub_names, $replace, $items, $plural_model_name);
                /// data for script
                foreach ($columns as $column) {
                    $COLUMN_NAME = $column->COLUMN_NAME;
                    $DATA_TYPE   = $column->DATA_TYPE;
                    if (! in_array($COLUMN_NAME, $skip_columns)) {
                        $stub_names = [
                            $plural_model_name => 'script_data',
                        ];
                        $replace = ['{{colum_name}}'];
                        $items   = [$COLUMN_NAME];
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
                $items   = [$singular_model_name, $plural_model_name];
                $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                $create_footer = ($this->option('ckeditor')) ? 'ckeditor_create_footer' : 'create_footer';
                $show_footer   = ($this->option('ckeditor')) ? 'ckeditor_show_footer' : 'show_footer';
                $stub_names    = [
                    $singular_model_name . "_add" => $create_footer
                    , $plural_model_name => 'index_footer'
                    , $singular_model_name . "_edit" => 'edit_footer'
                    , $singular_model_name . "_view" => $show_footer,
                ];
                if ($singular_model_name == 'user') {
                    $stub_names['my_profile'] = 'my_profile_footer';
                }
                $replace = ['{{name}}', '{{names}}'];
                $items   = [$singular_model_name, $plural_model_name];
                $this->view_builder($stub_names, $replace, $items, $plural_model_name, $theamName);
                // views
                // create
                $stub_name = ["class_name", "index"];
                $replace   = ['{{class_name}}', '{{name}}', '{{UC_name}}', '{{names}}'];
                $items     = [$ucfirst_singular_model_name, $singular_model_name, $ucfirst_singular_model_name, $plural_model_name];
                $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                // create
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
                        $items                  = [$REFERENCED_TABLE_NAME, Str::singular($REFERENCED_TABLE_NAME), $REFERENCED_COLUMN_NAME, $this->main_colum_name($REFERENCED_TABLE_NAME)];
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
                // create
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
                krsort($columns);
                foreach ($columns as $column) {
                    $COLUMN_NAME = $column->COLUMN_NAME;
                    $DATA_TYPE   = $column->DATA_TYPE;
                    if (! in_array($COLUMN_NAME, $column_skeps)) {
                        if (! in_array($COLUMN_NAME, $skip_id) && ! in_array($COLUMN_NAME, $boolean_values)) {
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
                    if (in_array($COLUMN_NAME, $auth_columns)) {
                        $stub_name = ["input_auth"];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_model_name, $COLUMN_NAME];
                        $this->controller_builder($stub_name, $ucfirst_singular_model_name, $replace, $items);
                    }
                    if (! in_array($COLUMN_NAME, $skip_id) && ! in_array($COLUMN_NAME, $skip_columns)) {
                        // create
                        $stub_name = ["input"];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_model_name, $COLUMN_NAME];
                        if (in_array($COLUMN_NAME, $files)) {
                            $stub_name = ["input_file"];
                            $replace   = ['{{names}}', '{{name}}', '{{input}}'];
                            $items     = [$plural_model_name, $singular_model_name, $COLUMN_NAME];
                        } elseif (in_array($COLUMN_NAME, $boolean_values)) {
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
                    if (! in_array($COLUMN_NAME, $skip_id) && ! in_array($COLUMN_NAME, $skip_columns)) {
                        // create
                        $stub_name = ["input"];
                        $replace   = ['{{name}}', '{{input}}'];
                        $items     = [$singular_model_name, $COLUMN_NAME];
                        if (in_array($COLUMN_NAME, $files)) {
                            $stub_name = ["input_file"];
                            $replace   = ['{{names}}', '{{name}}', '{{input}}'];
                            $items     = [$plural_model_name, $singular_model_name, $COLUMN_NAME];
                        } elseif (in_array($COLUMN_NAME, $boolean_values)) {
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
            $serv = $this->confirm("RUN  'php artisan serv' Command ?");
            if ($serv) {
                Artisan::call('serve');
            }
        }
    }
    protected function tableStrlen($value, $len = 10)
    {
        $strlen = strlen($value);
        if ($strlen <= $len) {
            $strlenValue = $len - $strlen;
            $value       = $value . str_repeat(' ', $strlenValue);
        } else {
            $strlenValue = $strlen - $len;
            $value       = substr($value, 0, -$strlenValue);
        }
        return $value;
    }
    protected function controller_builder($stub_names = [], $ucfirst_singular_model_name, $replace = [], $items = [])
    {
        foreach ($stub_names as $stub_name) {
            $phrase = "/stubs/make/controllers/$stub_name.stub";
            $create = $this->create($phrase, $replace, $items);
            file_put_contents(app_path("Http/Controllers/" . $this->app_name . "/" . $ucfirst_singular_model_name . "Controller.php"), $create, FILE_APPEND);
        }
    }
    protected function native_android_builder($stub_names = [], $ucfirst_singular_model_name, $replace = [], $items = [])
    {
        foreach ($stub_names as $stub_name) {
            $phrase = "/stubs/make/native-android/$stub_name.stub";
            $create = $this->create($phrase, $replace, $items);
            file_put_contents("native-android/xml/" . $ucfirst_singular_model_name . '.xml', $create, FILE_APPEND);
        }
    }
    protected function native_android_activity_builder($stub_names = [], $ucfirst_singular_model_name, $replace = [], $items = [])
    {
        foreach ($stub_names as $stub_name) {
            $phrase = "/stubs/make/native-android/$stub_name.stub";
            $create = $this->create($phrase, $replace, $items);
            file_put_contents("native-android/activites/" . $ucfirst_singular_model_name . '.java', $create, FILE_APPEND);
        }
    }
    protected function api_builder($stub_names = [], $replace = [], $items = [])
    {
        foreach ($stub_names['names'] as $stub_name) {
            $phrase = "/stubs/make/api/$stub_name.stub";
            $create = $this->create($phrase, $replace, $items);
            file_put_contents(app_path("Http/Controllers/API/" . $stub_names['controller_name'] . "APIController.php"), $create, FILE_APPEND);
        }
    }
    protected function lang_builder($stub_names = [], $replace = [], $items = [])
    {
        foreach ($stub_names as $stub_name) {
            $phrase = "/stubs/make/lang/$stub_name.stub";
            $create = $this->create($phrase, $replace, $items);
            file_put_contents(base_path("resources/lang/en/messages.php"), $create, FILE_APPEND);
        }
    }
    protected function json_lang_builder($stub_names = [], $replace = [], $items = [], $lang = 'en', $translateKey = null, $sleep = false, $path = 'lang/temp')
    {
        foreach ($stub_names as $i => $stub_name) {
            $phrase = "/stubs/make/lang/$stub_name.stub";
            if ($lang == 'ar' && $translateKey != null) {
                if ($sleep) {
                    if ($i > 0 && $i % 5 == 0) {
                        sleep(60);
                        $this->info('.');
                    }
                    // if ($this->confirm('Do you wont to translate '.$items[$translateKey].' ?' , 'yes')) {
                    $translateValue       = $this->translate($items[$translateKey]);
                    $items[$translateKey] = $translateValue;
                    // }
                } else {
                    if ($this->confirm('Do you wont to translate ' . $items[$translateKey] . ' ?', 'yes')) {
                        $translateValue       = $this->translate($items[$translateKey]);
                        $items[$translateKey] = $translateValue;
                    }
                }
            }
            $create = $this->create($phrase, $replace, $items);
        }
        file_put_contents(base_path($path . "/" . $lang . '.json'), $create, FILE_APPEND);
    }
    public function create($phrase, $replace = [], $items = [])
    {
        $replace   = Arr::add($replace, 'app_name', '{{app_name}}');
        $items     = Arr::add($items, 'app_name', $this->app_name);
        $phrase    = file_get_contents(__DIR__ . $phrase);
        $newphrase = str_replace($replace, $items, $phrase);
        return $newphrase;
    }
    public function createCustom($phrase, $replace = [], $items = [])
    {
        $replace   = Arr::add($replace, 'app_name', '{{app_name}}');
        $items     = Arr::add($items, 'app_name', $this->app_name);
        $phrase    = file_get_contents($phrase);
        $newphrase = str_replace($replace, $items, $phrase);
        return $newphrase;
    }
    protected function compileLang($phrase, $replace = [], $items = [])
    {
        $phrase    = file_get_contents(__DIR__ . $phrase);
        $newphrase = str_replace($replace, $items, $phrase);
        return $newphrase;
    }
    protected function compileRoute($phrase, $replace = [], $items = [])
    {
        $phrase    = file_get_contents(__DIR__ . $phrase);
        $newphrase = str_replace($replace, $items, $phrase);
        return $newphrase;
    }
    protected function createDirectories($model_name)
    {
        if (! is_dir(base_path("resources/views/$this->app_name/$model_name"))) {
            mkdir(base_path("resources/views/$this->app_name/$model_name"), 0755, true);
        }
    }
    protected function translate($text, $from_lan = 'en', $to_lan = 'ar')
    {
        $str_replace = str_replace("_", " ", $text);
        $url         = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=' . $from_lan . '&tl=' . $to_lan . '&dt=t&ie=UTF-8&oe=UTF-8&q=' . urlencode($str_replace);
        $handle      = curl_init($url);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response        = curl_exec($handle);
        $responseDecoded = json_decode($response, true);
        curl_close($handle);
        if (isset($responseDecoded[0][0][0])) {
            return $responseDecoded[0][0][0];
        } else {
            return $text;
        }
    }
    // tabels and colums function
    protected function tables($skip_tables = [], $db = 'app', $connection = 'mysql')
    {
        $table_list   = [];
        $return_array = [];
        if ($db == 'app') {
            $DB_NAME = env('DB_DATABASE');
        } else {
            $DB_NAME = $db;
        }
        $this->info("DB: " . $DB_NAME);
        $this->info("Connection: " . $connection);
        $tables = DB::connection($connection)->select('SHOW TABLES');
        if (! $tables) {
            $this->info('DB Error, could not list tables');
        }
        foreach ($tables as $table) {
            foreach ($table as $key => $value) {
                if (in_array($value, $skip_tables)) { // skip this tables
                    continue;
                } else {
                    $table_list[] = $value;
                }
            }
        }
        foreach ($table_list as $table) {
            $plural_TABLE_NAME   = Str::plural($table);
            $singular_TABLE_NAME = Str::singular($table);
            $columns             = DB::connection($connection)->select("SELECT COLUMN_NAME , DATA_TYPE ,COLUMN_COMMENT
       FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$plural_TABLE_NAME'");
            foreach ($columns as $column) {
                $COLUMN_NAME                        = $column->COLUMN_NAME;
                $DATA_TYPE                          = $column->DATA_TYPE;
                $return_array[$plural_TABLE_NAME][] = ['COLUMN_NAME' => $COLUMN_NAME, 'DATA_TYPE' => $DATA_TYPE];
            }
        }
        return $return_array;
    }
    protected function main_colum_name($table_name, $connection = 'mysql')
    {
        $DB_NAME      = DB::connection($connection)->getDatabaseName();
        $return_array = [];
        $columns      = DB::connection($connection)->select("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$table_name'");
        $main_colum_name = (count($columns) >= 1) ? $columns[1]->COLUMN_NAME : "id";
        $this->info('Connection      : ' . $connection);
        $this->info('Table_name      : ' . $table_name);
        $this->info('Main_colum_name : ' . $main_colum_name);
        return $main_colum_name;
    }
    protected function main_pk($table_name, $connection = 'mysql')
    {
        $DB_NAME      = DB::connection($connection)->getDatabaseName();
        $return_array = [];
        $columns      = DB::connection($connection)->select("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_SCHEMA = '$DB_NAME' AND TABLE_NAME = '$table_name'");
        $main_colum_name = (count($columns) >= 1) ? $columns[0]->COLUMN_NAME : "id";
        $this->info('Connection      : ' . $connection);
        $this->info('Table_name      : ' . $table_name);
        $this->info('PK : ' . $main_colum_name);
        return $main_colum_name;
    }
    /////////////////neeed
    protected function unlink_file($file_pointer)
    {
        if (! file_exists($file_pointer)) {
            return $this->info("$file_pointer : No such file or directory");
        }
        if (! unlink($file_pointer)) {
            $this->info("$file_pointer cannot be deleted due to an error");
        } else {
            $this->info("$file_pointer has been deleted");
        }
    }
    protected function create_views($phrase, $replace = [], $items = [])
    {
        $phrase    = file_get_contents(__DIR__ . $phrase);
        $newphrase = str_replace($replace, $items, $phrase);
        return $newphrase;
    }
    protected function view_builder($stub_names = [], $replace = [], $items = [], $plural_model_name, $theam = 'vuexy')
    {
        foreach ($stub_names as $key => $stub_name) {
            $phrase            = "/stubs/make/forms/" . $theam . "/" . $stub_name . ".stub";
            $compileViewHeader = $this->create_views($phrase, $replace, $items);
            file_put_contents(
                base_path("resources/views/$this->app_name/$plural_model_name/" . $key . ".blade.php"),
                $compileViewHeader,
                FILE_APPEND
            );
        }
    }
    public function create_dir($flutter_folder)
    {
        // johan v2
        if (! is_dir(base_path($flutter_folder))) {
            mkdir(base_path($flutter_folder), 0755, true);
        }
    }
    public function check_td_column($COLUMN_NAME)
    {
        $pure_td_column = 'pure_td_column';
        if (in_array($COLUMN_NAME, $this->files)) {
            $pure_td_column = 'pure_td_column_image';
        }
        if (in_array($COLUMN_NAME, $this->booleanValues)) {
            $pure_td_column = 'pure_td_column_boolan';
        }
        return $pure_td_column;
    }
    protected function search_view_builder($stub_names = [], $replace = [], $items = [], $plural_model_name, $theam = 'vuexy', $reportDir = null)
    {
        foreach ($stub_names as $key => $stub_name) {
            $phrase            = "/stubs/make/forms/" . $theam . "/search/" . $stub_name . ".stub";
            $compileViewHeader = $this->create_views($phrase, $replace, $items);
            file_put_contents(
                base_path("resources/views/$this->app_name/$reportDir/search.blade.php"),
                $compileViewHeader,
                FILE_APPEND
            );
        }
    }
    public function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini    = strpos($string, $start);
        if ($ini == 0) {
            return '';
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    protected function deletedir($dir, $showMsgs = true)
    {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    if (filetype($dir . "/" . $file) == "dir") {
                        $this->deletedir($dir . "/" . $file, $showMsgs);
                    } else {
                        unlink($dir . "/" . $file);
                    }
                }
                if ($showMsgs) {
                    $this->info("$file deleted successfully!");
                }
            }
            if (rmdir($dir)) {
                if ($showMsgs) {
                    $this->info('deleted successfully!');
                }
            } else {
                if ($showMsgs) {
                    $this->info('delete failed!');
                }
            }
        } else {
            if ($showMsgs) {
                $this->info('doesn\'t exist or inaccessible!');
            }
        }
    }
    // 2025
    public function append_to($stub_file, $file, $replace = [], $items = [])
    {
        $contents     = file_get_contents(__DIR__ . $stub_file);
        $new_contents = str_replace($replace, $items, $contents);
        file_put_contents($file, $new_contents, FILE_APPEND);
    }
}
