<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class JohanFlutter extends johan
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:flutter
    {--new : create new app }
    {--run : flutter run command }
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create flutter app';

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

$packages = [
    'mobx' ,
    'flutter_mobx',
    'nb_utils',
    

    'google_maps_flutter',
    'html',
    'intl' ,
    'google_fonts' , 
  
  # integrations errors
    'flutter_reaction_button' ,
    'lottie' ,
    'showcaseview' ,
    'clippy_flutter' ,
  
  
    # IMAGES
    'cached_network_image' ,
    'image_picker' ,
    'file_picker' ,
  
    # VIDEOS
    'video_player' ,
  
    # AUTHENTICATION
    'google_sign_in' ,
    'local_auth' ,
  
     # UI
    # 'simple_animations' ,
    'flutter_svg' ,
    # 'flutter_slidable' ,
    # 'flutter_staggered_grid_view' ,
    # 'flutter_staggered_animations' ,
    'flutter_colorpicker' ,
    'signature' ,
    # 'dots_indicator' ,
    # 'percent_indicator' ,
    # 'flutter_rating_bar' ,
    'carousel_slider' ,
    # 'animations' ,
    # 'lottie' ,
    'liquid_swipe',
    # 'clippy_flutter'  ,
    # 'flutter_reaction_button' ,
    # 'showcaseview' ,
  
    
  
    # NOTIFICATION
    # 'flutter_local_notifications' ,
    'flutter_local_notifications' ,
    'country_code_picker' 
];

        if ($this->option('new')) { 

        }


        $run = false;

        if ($this->option('run')) {
            $run = true;
        }

       

        $flutter_app_name = strtolower($this->app_name);

        $flutter_folder = "flutter";
        $this->create_dir($flutter_folder);
       
        $app = $flutter_folder.'/'.$flutter_app_name;


        $this->info('App Name : ' . $flutter_app_name);

 
 
      $output = shell_exec('flutter create '.$app);
       echo $output;

        $this->info('flutter working folder is ' . $app);

        

        $output = shell_exec(' cd ' .$app.' && code .');

        foreach($packages as $key => $package){
            if($key == 0){
    $output = shell_exec(' cd ' .$app);
     
            }
      $grep = shell_exec('cd ' .$app.' && flutter pub pub deps | grep  '.$package);
      if(!$grep){
        $output = shell_exec('cd ' .$app.' && flutter pub add '.$package);
        echo $output ;
      }else{
        $this->info($grep);
    
      }
   
        }

       $output = shell_exec(' cd ../.. ');

 
       $newdir = "flutter/".strtolower($this->app_name)."/lib/main/utils";

       $this->create_dir($newdir);

       $newdir = "flutter/".strtolower($this->app_name)."/lib/main/store";

       $this->create_dir($newdir);

       $newdir = "flutter/".strtolower($this->app_name)."/lib/screens";

       $this->create_dir($newdir);
   
       $newdir = "flutter/".strtolower($this->app_name)."/lib/colors";

       $this->create_dir($newdir);


       $newdir = "flutter/".strtolower($this->app_name)."/images";

       $this->create_dir($newdir);


       copy("public/flutter/intro/intro1.png","flutter/".strtolower($this->app_name)."/images/intro1.png");
       copy("public/flutter/intro/intro2.png","flutter/".strtolower($this->app_name)."/images/intro2.png");
       copy("public/flutter/intro/intro3.png","flutter/".strtolower($this->app_name)."/images/intro3.png");
       copy("public/flutter/logo/logo.png","flutter/".strtolower($this->app_name)."/images/logo.png");

       


       $subfolder = 'colors';
       $stub_names = [
           "Colors" => 'Colors' , 
           ];
           $replace = ['{{appname}}'];
           $items = [$flutter_app_name];
           $this->flutter_builder($stub_names  , $replace , $items  , $subfolder);
       

       
       $subfolder = 'screens';
       $stub_names = [
           "SplashScreen" => 'SplashScreen' , 
           "WalkThroughScreen" => 'WalkThroughScreen' , 
           ];
           $replace = ['{{appname}}'];
           $items = [$flutter_app_name];
           $this->flutter_builder($stub_names  , $replace , $items  , $subfolder);
       



        $replace = ["{{appnam}}"] ;
        $items = [$flutter_app_name];

        $phrase  = "/stubs/make/flutter/main.stubs";
        $create = $this->create($phrase ,$replace , $items );
        file_put_contents(base_path("flutter/".strtolower($this->app_name)."/lib/main.dart"),$create);

 
        
        $subfolder = 'main/store';
        $stub_names = [
            "AppStore" => 'AppStore' , 
            "AppStore.g" => 'AppStore.g' , 
            ];
            $replace = ['{{appname}}'];
            $items = [$flutter_app_name];
            $this->flutter_builder($stub_names  , $replace , $items  , $subfolder);



        $subfolder = 'main/utils';
        $stub_names = [
            "AppColors" => 'AppColors' , 
            "AppConstant" => 'AppConstant' , 
            "AppTheme" => 'AppTheme' , 
            ];
            $replace = ['{{appname}}'];
            $items = [$flutter_app_name];
            $this->flutter_builder($stub_names  , $replace , $items  , $subfolder);



            $replace = ["# assets:"] ;
            $items = ["assets:
            - images/
            #newimage
            "];
    
            $phrase  = base_path("flutter/".strtolower($this->app_name)."/pubspec.yaml");
            $create = $this->createCustom($phrase ,$replace , $items );
            file_put_contents(base_path("flutter/".strtolower($this->app_name)."/pubspec.yaml"),$create);

            // $replace = ["# assets:"] ;
            // $items = ["assets:
            // - images/a_dot_burr.jpeg
            // #newimage
            // "];
    
            // $phrase  = base_path("flutter/".strtolower($this->app_name)."/pubspec.yaml");
            // $create = $this->createCustom($phrase ,$replace , $items );
            // file_put_contents(base_path("flutter/".strtolower($this->app_name)."/pubspec.yaml"),$create);


            // $replace = ["#newimage"] ;
            // $items = ["- images/a_dot_ham.jpeg
            // #newimage
            // "];
    
            // $phrase  = base_path("flutter/".strtolower($this->app_name)."/pubspec.yaml");
            // $create = $this->createCustom($phrase ,$replace , $items );
            // file_put_contents(base_path("flutter/".strtolower($this->app_name)."/pubspec.yaml"),$create);


            if($run) {
                $grep = shell_exec('cd ' .$app.' && flutter run');
  
            }
    }



    
    protected function flutter_builder($stub_names = [] ,  $replace = [] , $items = []  ,  $subfolder = 'main/utils'){

        foreach ($stub_names as $key => $stub_name) {
$phrase =  "/stubs/make/flutter/".$subfolder."/".$stub_name . ".stubs" ;

$create = $this->create($phrase , $replace , $items );
 

file_put_contents(base_path("flutter/".strtolower($this->app_name)."/lib/".$subfolder."/".$key.".dart"),$create);

}
}


  
}
