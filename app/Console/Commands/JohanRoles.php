<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class JohanRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'johan:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate roles and permissions based on database tables';

    /**
     * List of tables to skip while creating permissions.
     *
     * @var array
     */
    private $skipTables = [
        'migrations', 'password_resets',
        'oauth_access_tokens', 'oauth_auth_codes',
        'oauth_clients', 'oauth_personal_access_clients',
        'oauth_refresh_tokens', 'failed_jobs',
        'personal_access_tokens', 'sessions',
        'team_invitations', 'teams',
        'model_has_permissions', 'model_has_roles',
        'roles', 'cache', 'cache_locks',
        'job_batches', 'jobs', 'password_reset_tokens',
        'permissions', 'role_has_permissions',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching database tables...');

        $tables = $this->getDatabaseTables();
        $filteredTables = $this->filterTables($tables);

        $this->info('Creating admin role and permissions...');
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        foreach ($filteredTables as $table) {
            $this->createPermissionsForTable($table, $adminRole);
        }

        $this->info('Assigning roles to User ID 1...');
        $user = User::find(1);

        if ($user) {
            $user->assignRole($adminRole);
            $this->info("Role '{$adminRole->name}' assigned to User ID 1.");
        } else {
            $this->error("User ID 1 not found.");
        }

        $this->info('Roles and permissions generated successfully.');
    }

    /**
     * Get a list of all database tables.
     *
     * @return array
     */
    private function getDatabaseTables(): array
    {
        $tables = DB::connection('mysql')->select('SHOW TABLES');
        $tableList = [];

        foreach ($tables as $table) {
            $tableList[] = reset($table); // Get the first column value
        }

        return $tableList;
    }

    /**
     * Filter out tables that should be skipped.
     *
     * @param array $tables
     * @return array
     */
    private function filterTables(array $tables): array
    {
        return array_filter($tables, function ($table) {
            return !in_array($table, $this->skipTables);
        });
    }

    /**
     * Create permissions for a given table and assign them to a role.
     *
     * @param string $table
     * @param Role $role
     * @return void
     */
    private function createPermissionsForTable(string $table, Role $role): void
    {
        $actions = ['create', 'update', 'delete'];

        foreach ($actions as $action) {
            $permissionName = "$action $table";
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $role->givePermissionTo($permission);
        }

        $this->info("Permissions created for table: $table");
    }
}
