<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class TenantDatabaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $domain = $request->header('domain') ?: $request->getHost();
            if ($domain) {
                $tenant = Tenant::where('domain', $domain)->first();
                if ($tenant) {
                    config([
                        'database.connections.tenant' => [
                            'driver' => 'mysql',
                            'host' => env('DB_HOST_TENANT'),
                            'database' => $tenant->database,
                            'username' => env('DB_USERNAME_TENANT'),
                            'password' => env('DB_PASSWORD_TENANT'),
                        ]
                    ]);

                    // Log the database name for debugging
                    Log::info('Switching to tenant database', [
                        'database' => $tenant->database
                    ]);

                    // Set the tenant connection as the default connection
                    DB::setDefaultConnection('tenant');

                    // Reconnect to the tenant database to ensure it's selected
                    DB::reconnect('tenant');

                    // Check the current database connection
                    $currentDatabase = DB::connection('tenant')->getDatabaseName();
                    Log::info('Current database: ' . $currentDatabase);
                } else {
                    return response()->json(['error' => 'Tenant not found'], 404);
                }
            } else {
                return response()->json(['error' => 'Domain not provided.'], 422);
            }

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
