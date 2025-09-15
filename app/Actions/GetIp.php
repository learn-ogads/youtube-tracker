<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetIp
{
    /**
     * Get the IP address from the request
     */
    public static function execute(Request $request): string
    {
        /**
         * Get the IP Address
         */
        $ip = $request->ip();

        /**
         * When local, use the testing ip address
         */
        if (App::environment('local')) {
            $ip = config('services.ip_whitelist.local_ip');
        }

        /**
         * Return ip address
         */
        return $ip;
    }
}
