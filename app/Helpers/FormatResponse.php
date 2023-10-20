<?php

namespace App\Helpers;

class FormatResponse
{
    public static function success($message, $data, $status = true)
    {
        $fail = response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $data,
        ]);

        $success = response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
        return $status ? $success : $fail;
    }
}