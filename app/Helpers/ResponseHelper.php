<?php
namespace App\Helpers;

class ResponseHelper
{
    public static function success($data = [], $message = 'Request successful', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $statusCode);
    }

    public static function error($message = 'Something went wrong', $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => null,
        ], $statusCode);
    }
}
