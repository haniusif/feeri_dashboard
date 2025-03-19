<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class JohanLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:login {--iconhiget=100 : Icon height} {--iconwidth=100 : Icon width}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Login page control';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $height = $this->option('iconhiget');
        $width = $this->option('iconwidth');

        // Validate inputs
        if (!is_numeric($height) || !is_numeric($width)) {
            $this->error("Icon dimensions must be numeric.");
            return;
        }

        $path = resource_path('views/auth/login.blade.php');

        // Check for file overwrite
        if (File::exists($path) && !$this->confirm("The view 'login' already exists! Overwrite?")) {
            $this->info("Operation cancelled.");
            return;
        }

        // Ensure the directory exists
        File::ensureDirectoryExists(dirname($path), 0755);

        // Clear or create the Blade file
        File::put($path, '');

        // Append content from stub files
        $this->buildLoginPage($path, $height, $width);

        $this->info("The 'login' page has been updated successfully with dimensions: Height = {$height}, Width = {$width}.");
    }

    /**
     * Build the login page content from stub files.
     *
     * @param string $path
     * @param int $height
     * @param int $width
     * @return void
     */
    private function buildLoginPage(string $path, int $height, int $width)
    {
        // Append the main sections
        $this->appendStubContent($path, app_path("Console/Commands/Stubs/Login/header.stub"), [
            '{{$height}}' => $height,
            '{{$width}}' => $width,
        ]);

        $this->appendStubContent($path, app_path("Console/Commands/Stubs/Login/form_header.stub"));

        // Choose login type
        $formType = $this->choice(
            'What is login type?',
            ['Username & password', 'Email & password', 'Phone number & password', 'OTP'],
            'Email & password'
        );

        $loginTypeStub = match ($formType) {
            'Username & password' => 'username_and_password',
            'Email & password' => 'email_and_password',
            'Phone number & password' => 'phone_number_and_password',
            'OTP' => 'otp',
            default => 'email_and_password',
        };

        $this->appendStubContent($path, app_path("Console/Commands/Stubs/Login/{$loginTypeStub}.stub"));

        // Optionally append registration form
        if ($loginTypeStub !== 'otp' && $this->confirm('User can register?')) {
            $this->appendStubContent($path, app_path("Console/Commands/Stubs/Login/form_register.stub"));
        }

        // Optionally append social login form
        if ($this->confirm('User can login with social accounts?')) {
            $this->appendStubContent($path, app_path("Console/Commands/Stubs/Login/form_social.stub"));
        }

        // Append footer sections
        $this->appendStubContent($path, app_path("Console/Commands/Stubs/Login/form_footer.stub"));
        $this->appendStubContent($path, app_path("Console/Commands/Stubs/Login/footer.stub"));
    }

    /**
     * Append content from a stub file to the target file, replacing placeholders.
     *
     * @param string $targetPath
     * @param string $stubPath
     * @param array $placeholders
     * @return void
     */
    private function appendStubContent(string $targetPath, string $stubPath, array $placeholders = [])
    {
        if (!File::exists($stubPath)) {
            $this->error("Stub file not found: {$stubPath}");
            return;
        }

        $stubContent = File::get($stubPath);
        $content = str_replace(array_keys($placeholders), array_values($placeholders), $stubContent);

        if (File::append($targetPath, $content) === false) {
            $this->error("Failed to append content from stub: {$stubPath}");
        }
    }
}
