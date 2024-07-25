<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 7/25/24
 */

namespace Core\Project\Illuminate\BaseApi;

use Illuminate\Support\Facades\Response;

class ResponseApiService
{
    const SUCCESS_CODE = "success";
    public static function sendError($message, $option = []): \Illuminate\Http\JsonResponse
    {
        return Response::json([
            'status'     => data_get($option, "status", "error"),
            'error_code' => data_get($option, "error_code", 1),
            'message'    => $message,
            'data'       => data_get($option, "data", [])
        ], data_get($option, "status_code", 500));
    }

    public static function sendSuccess($data = [], string $message = "successfully"): \Illuminate\Http\JsonResponse
    {
        return Response::json([
            'status'     => self::SUCCESS_CODE,
            'error_code' => 0,
            'message'    => $message,
            'data'       => $data
        ], 200);
    }
}