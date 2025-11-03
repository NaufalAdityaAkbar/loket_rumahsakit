<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IgnoreSSL
{
    public function handle(Request $request, Closure $next)
    {
        if (config('app.env') === 'local') {
            // Disable SSL verification globally
            \Config::set('services.google.guzzle', [
                'verify' => false,
                'curl' => [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false
                ]
            ]);
            
            // Set default SSL verify to false for all requests
            if (class_exists('\GuzzleHttp\Client')) {
                \GuzzleHttp\Client::setDefaultOptions([
                    'verify' => false
                ]);
            }
        }
        
        return $next($request);
    }
}