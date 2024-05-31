<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MigrateTenant extends Command
{
    protected $signature = 'tenants:artisan {artisanCommand} {--tenant=} {--databaseName=}';
    protected $description = 'Run Artisan commands for a specific tenant';

    public function handle()
    {
        $artisanCommand = $this->argument('artisanCommand');
        $tenantId = $this->option('tenant');
        $database = $this->option('databaseName');

        // Log or handle the tenant ID if needed
        $this->info("Tenant ID: $tenantId, Database Name: $database");

        Config::set('database.connections.tenant', [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => $database,
            'username' => env('DB_USERNAME_TENANT'),
            'password' => env('DB_PASSWORD_TENANT'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]);

        // Set the database connection to the 'tenant' connection
        DB::purge('tenant');
        DB::setDefaultConnection('tenant');

        // Run migrations for the specified path
        Artisan::call('migrate', ['--force' => true, '--path' => 'database/migrations/tenant']);

        $this->info("Command '$artisanCommand' run for tenant '$database'.");
    }
}
