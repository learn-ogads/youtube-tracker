<?php

namespace App\Http\Middleware;

use App\Actions\GetIp;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpWhitelistMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Get allowed IP addresses
         */
        $allowed_ips = config('services.ip_whitelist.whitelist');

        /**
         * Get the IP address of the request
         */
        $ip_address = GetIp::execute($request);

        if (!in_array($ip_address, $allowed_ips)) {
            abort(401, 'Unauthorized');
        }

        return $next($request);
    }
}
