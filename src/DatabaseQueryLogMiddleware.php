<?php

namespace Nonegrame\LaravelJsonQueryLog;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DatabaseQueryLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 沒開就不顯示 query log
        if (!env('DEBUG_QUERY_ENABLED', false)) {
            $response = $next($request);
            return $response;
        }

        // Pre-Middleware Action
        DB::connection()->enableQueryLog();

        $response = $next($request);

        // Post-Middleware Action
        if (!$response instanceof JsonResponse) {
            return $response;
        }

        $responseArray = json_decode($response->getContent(), true);
        if (!is_array($responseArray)) {
            return $response;
        }

        $responseArray['_query_log'] = DB::getQueryLog();
        $response->setData($responseArray);

        return $response;
    }
}
