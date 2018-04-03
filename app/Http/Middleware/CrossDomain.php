<?php

namespace App\Http\Middleware;

use Closure;

class CrossDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->getMethod() == "OPTIONS") {
            $response = response()->json(['success' => true,]);
        } else {
            $response = $next($request);
        }

        $allow_hosts = [
            'localhost',
            '127.0.0.1',
            'taskManager.localhost'
        ];
        $origin = $request->headers->get('Origin');


        if (in_array(parse_url($origin, PHP_URL_HOST), $allow_hosts)) {
            $headers = [
                'Access-Control-Allow-Origin' => $origin,
                'Access-Control-Allow-Methods' => 'OPTIONS,GET,POST,PUT,DELETE',
                'Access-Control-Allow-Credentials' => 'true',
                'Access-Control-Max-Age' => '10000',
                'Access-Control-Allow-Headers' => 'Authorization, Token, Content-Type, Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, X-E4M-With',
            ];
            $response->headers->add($headers);
        }
        return $response;
    }
}
