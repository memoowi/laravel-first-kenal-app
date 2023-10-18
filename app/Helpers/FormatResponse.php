<?php

namespace App\Helpers;

class FormatResponse
{
    public static function success($message, $data = null)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }
}