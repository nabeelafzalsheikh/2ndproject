<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    
        // Extract the tenant name from the subdomain
        $tenant = $request->route('tenant'); // www.abc.com/{tenant}/...

        if ($tenant) {
            // Dynamically set the database connection for the tenant
            $this->setTenantDatabaseConnection($tenant);
        }

        return $next($request);
    }

    protected function setTenantDatabaseConnection($tenant)
    {
        // Check if the database for the tenant exists
        $tenantDatabase = $tenant; // Assume the database name is the same as the tenant name

        Config::set('database.connections.tenant.database', $tenantDatabase);

        // Set the default connection to the tenant database
        DB::setDefaultConnection('multi-tanent');
    }
    }

