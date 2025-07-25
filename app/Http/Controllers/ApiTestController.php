<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiTestController extends Controller
{
    /**
     * Test API functionality
     */
    public function test(Request $request)
    {
        return response()->json([
            'message' => 'API is working!',
            'request_info' => [
                'is_json' => $request->expectsJson(),
                'wants_json' => $request->wantsJson(),
                'is_api_route' => $request->is('api/*'),
                'accept_header' => $request->header('Accept'),
                'content_type' => $request->header('Content-Type'),
                'method' => $request->method(),
                'path' => $request->path(),
            ]
        ]);
    }

    /**
     * Test authentication
     */
    public function authTest(Request $request)
    {
        return response()->json([
            'message' => 'You are authenticated!',
            'user' => $request->user()
        ]);
    }
}