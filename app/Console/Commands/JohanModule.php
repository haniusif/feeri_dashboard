<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Module;

class JohanModule extends johan
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:module
 
    {--translate : translate all modules with google translate api }
    {--parent : create all modules as a parent modules}
    {--del : delete all modules}
    {--hide : hide tables and translate result while creating modules}
    
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Sidebar Modules';

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


        $hideAll = false;
        if ($this->option('hide')) {
            $hideAll = true;

        }
      
        $headers = ['LIST OF TABLEs','COUNT OF COLUMS'];

        $tables = $this->tables($this->skipTables);

        foreach ($tables as $key => $table_value) {
     
            $column_count = count($table_value);
            $table_list[] =  $key;
            $table_list_to_show[] =  [$key,$column_count];
                }

        if(!$hideAll){
            $this->table($headers, $table_list_to_show);   
        }

       

        $translateAll = false;
        if ($this->option('translate')) {
            $translateAll = true;
            $parent_id = 0;
        }

        $parentAll = false;

        if ($this->option('parent')) {
            $parentAll = true;
        }

        $ModulesCount = Module::count();
        if(!$delAll && $ModulesCount >= 1){
         if ($this->confirm('Do you wont to delete old modules configrations ?')) {
        
               $Modules = Module::all();
               foreach($Modules as $Module){
               $Module->delete();
                $this->info('Moduel No.' .$Module->id.' was deleted successfully');
               }
               }
              }else{
                $this->info('Starting ...');
    
              }
        
              $tables = $this->tables($this->skipTables);

         
        
               $tabels_array_keys = array_keys($tables);
               $parent_id = 0;
        
               foreach($tabels_array_keys as $key => $table){
                $module_list_to_show = [];
                $module_names = [];
        
                $Modules = Module::all();
        
                if(count($Modules) >= 1) {

         
                foreach ($Modules as $key => $Module_value) {
                 $module_names[] =  $Module_value->en_name;
        
                 $module_list_to_show[] =  [$this->tableStrlen($Module_value->id , 5)   , $this->tableStrlen($Module_value->parent_id , 5)  , $this->tableStrlen($Module_value->en_name , 30)   , $this->tableStrlen($Module_value->name , 50)  ];
                 }
        
                 $headers = ['ID' , 'Parent ID' ,'En Name' ,'Name'];
        

                 
                 if(!$hideAll){
                    $this->table($headers, $module_list_to_show);   
                }

                 if(!$parentAll){
        
               if ($this->confirm($table . ' is parent module ?' ,'yes')) { 
               $parent_id = 0;
        
               }else{
         
                
                $name = $this->choice(
                    'What is the module name?',
                    $module_names,
                    0
                );
        
              
                $this->info('Your Answer is ' . $name);
        
                $parent_id = Module::whereEnName($name)->first()->id;
                 
        
               }
            }
        
            }
        
            $Module_name = $table ; 
          

            if($translateAll){

                $translate = $this->translate($table);
                $this->info($translate . ' = ' . $table);
                $Module_name = $translate ; 

            }else{

                if ($this->confirm('translate '  . $table . '  ?' ,'yes')) { 
                    $translate = $this->translate($table);
                    $this->info($translate . ' = ' . $table);
                    $Module_name = $translate ; 

                 }

            }
           
            
        
         
              
        
        
               $Module = new Module ();
               $Module->name = $Module_name;
               $Module->en_name = $table;
               $Module->route = $table;
               $Module->image = '/images/modules/default.png';
               $Module->icon = '<i class="feather icon-box"></i>';
               $Module->parent_id = $parent_id;
        
               $Module->user_type_ids = '1,2,3,4,5,6,7,8,9,10';
               $Module->is_active = 1;
               $Module->sorting = ($key+1);
               $Module->save();
        
                $this->info($table .' was craeteed successfully');
               }
        

               if(!$hideAll){

                $this->table(
                    ['ID' , 'Parent ID' ,'Name' ,'En Name' ],
                    Module::all(['id', 'parent_id' , 'name' , 'en_name'])->toArray()
                );            }
        
            
        
        
               $serv =  $this->confirm("RUN  'php artisan serv' Command ?");
               if($serv){
                 Artisan::call('serve');
               }
        
        

    }
}
