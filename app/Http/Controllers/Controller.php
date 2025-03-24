<?php

namespace App\Http\Controllers;

abstract class Controller
{
    const SUCCESS = 1;
    const ERROR = 2;

    public function getResponseJson($code, $data)
    {
        return response()->json(
            [
                'code' => $code,
                'data' => $data,
            ]
        );
    }

    public function setMessage($message)
    {
        return [
            'message' => $message,
        ];
    }
}
