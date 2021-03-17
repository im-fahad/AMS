<?php


if (!function_exists('res')) {
    function res($data, string $key = null, int $statusCode = 200)
    {
        if ($key) {
            $data = [$key => $data];
        }
        return response()->json($data, $statusCode);
    }
}


if (!function_exists('not_found_res')) {
    function not_found_res($message = 'Sorry, could not find what you are loking for.')
    {
        if (!is_array($message)) {
            $message = [
                'success' => false,
                'message' => $message
            ];
        }
        return response()->json($message,404);
    }
}

if (!function_exists('bad_req_res')){
    function bad_req_res(string $message = 'Bad Request', int $statusCode = 400){
        if (!is_array($message)) {
            $message = [
                'success' => false,
                'message' => $message
            ];
        }
        return response()->json($message,$statusCode);
    }
}

if (!function_exists('success_res')) {
    function success_res(string $message = 'Request successful.', int $statusCode = 201)
    {
        $data = [
            'success' => true,
            'message' => $message
        ];

        return response()->json($data, $statusCode);
    }
}

if (!function_exists('error_res')) {
    function error_res(string $message = 'Sorry something went wrong.', int $statusCode = 406)
    {
        $data = [
            'success' => false,
            'message' => $message
        ];

        return response()->json($data, $statusCode);
    }
}

if (!function_exists('unauthorized_res')) {
    function unauthorized_res(string $message = 'Unauthorized', int $statusCode = 401)
    {
        $message = [
            'success' => false,
            'message' => $message
        ];

        return response()->json($message, $statusCode);
    }
}
