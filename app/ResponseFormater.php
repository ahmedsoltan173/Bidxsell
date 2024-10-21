<?php

namespace App;

use Illuminate\Http\JsonResponse;

trait ResponseFormater
{

        protected function success($data_name,$data, string $message = null, int $code = 200): JsonResponse
        {
            return response()->json([
                'status' => 'Success',
                'message' => $message,
                $data_name => $data
            ], $code);
        }


        protected function error(string $message = null, int $code, $data = null): JsonResponse
        {
            return response()->json([
                'status' => 'Error',
                'message' => $message,
                'data' => $data
            ], $code);
        }


}
