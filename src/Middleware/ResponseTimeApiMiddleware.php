<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 7/25/24
 */

namespace Core\Project\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ResponseTimeApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        $start_time = microtime(true);

        $response = $next($request);

        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time) * 1000; // Thời gian phản hồi tính bằng millisecond

        if ($execution_time > 300) {
            Log::info("======= [PERFORMANCE] ========");
            Log::warning("======= {$request->method()} |  ==== {$execution_time} ms === | {$request->route()->uri()}");
            Log::info("======= [END PERFORMANCE] ======== \n");
        }

        return $response;
    }
}