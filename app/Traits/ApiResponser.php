<?php

namespace App\Traits;

trait ApiResponser
{
    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json(
            [
                'status'=> $code,
                'success'=> true,
                'message' => $message,
                'data' => $data,
            ],
            $code
        );
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(
            [
                'status'=>$code,
                'success'=> false,

                'message' => $message,
                'data' => null,
            ],
            200
        );
    }
}