<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class JohanNewPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:new_page {--empty=true : Option for empty page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Blade page';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ask for the page name
        $name = $this->ask('What is the page name?');

        // Validate the input
        if (empty($name)) {
            $this->error("Page name cannot be empty.");
            return;
        }

        // Generate the full path for the view file
        $path = resource_path('views/' . str_replace('.', '/', $name) . '.blade.php');

        // Check if the view file already exists
        if (File::exists($path)) {
            if (!$this->confirm("The view '{$name}' already exists! Do you want to overwrite it?")) {
                $this->info("Operation cancelled.");
                return;
            }
        }

        // Ensure the directory exists
        $directory = dirname($path);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Path to the stub file
        $stubPath = app_path('Console/Commands/Stubs/General/make_view.stub');

        // Check if the stub file exists
        if (!File::exists($stubPath)) {
            $this->error("Stub file not found at '{$stubPath}'.");
            return;
        }

        // Load the stub file content
        $stubContent = File::get($stubPath);

        // Replace placeholder with the view name
        $content = str_replace('{{$name}}', $name, $stubContent);

        // Create or overwrite the view file
        File::put($path, $content);

        // Inform the user
        $this->info("The page '{$name}' has been created successfully.");
        $this->info("Goodbye!");
    }
}
