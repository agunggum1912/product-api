<?php

namespace App\Http\Traits;

Trait JsonResponse {

    function json200($data = [], $message = '') {
        return response()->json([
            'code' => 200,
            'data' => $data,
            'message' => $message
        ], 200);
    }

    function json201($data, $message) {
        return response()->json([
            'code'    => 201,
            'data'      => $data,
            'message'   => $message
        ], 201);
    }

    function json400($message = '', $data = null) {
        return response()->json([
            'code' => 400,
            'data'  => $data,
            'message' => $message
        ], 400);
    }

    function json401() {
        return response()->json([
            'code'    => 401,
            'data'      => NULL,
            'message'   => 'Unauthorized'
        ], 401);
    }

    function json403() {
        return response()->json([
            'code'    => 403,
            'data'      => NULL,
            'message'   => 'Forbidden'
        ], 403);
    }

    function json404() {
        return response()->json([
            'code'    => 404,
            'data'      => NULL,
            'message'   => 'Page Not Found'
        ], 404);
    }

    function json405() {
        return response()->json([
            'code'    => 405,
            'data'      => NULL,
            'message'   => 'Method Not Allowed'
        ], 405);
    }

    function json500() {
        return response()->json([
            'code'    => 500,
            'data'      => NULL,
            'message'   => 'Internal Server Error'
        ], 500);
    }

    function json503() {
        return response()->json([
            'code'    => 503,
            'data'      => NULL,
            'message'   => 'Service Unavailable or Under Maintenance'
        ], 503);
    }

}
