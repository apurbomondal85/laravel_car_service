<?php

namespace App\Library;

class Response
{
    public static function success(string $message, mixed $data = null)
    {
        $body = [
            'success' => true,
            'message' => $message
        ];

        if($data) {
            $body['data'] = $data;
        }

        return response()->json($body);
    }

    public static function error(string $message, array $errors = [], $code = 400)
    {
        $body = [
            'success' => false,
            'message' => $message
        ];

        if($errors) {
            $body['data'] = $errors;
        }

        return response()->json($body, $code);
    }

}
