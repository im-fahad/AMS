<?php


namespace App\Services;


class MessageService extends Service
{
    public function success($message = 'Success!')
    {
        return response()->json([
            'status' => 200,
            'message' => $message
        ]);
    }

    public function fails($message = 'Bad Request')
    {
        return response()->json([
            'status' => 400,
            'message' => $message
        ]);
    }

    public function error($message = 'Unauthorized')
    {
        return response()->json([
            'status' => 500,
            'message' => $message
        ]);
    }
}
