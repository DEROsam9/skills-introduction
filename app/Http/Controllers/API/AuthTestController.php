<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;


class AuthTestController extends Controller
{
    public function getToken(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
        'grant_type' => 'password',
        'client_id' => env('PASSPORT_CLIENT_ID'),
        'client_secret' => env('PASSPORT_CLIENT_SECRET'),
        'username' => $request->email,
        'password' => $request->password,
        'scope' => '*'
    ]);

    if ($response->successful()) {
        return response()->json([
            'status' => 1,
            'message' => 'Successfully authenticated',
            'data' => $response->json()
        ]);
    }

    return response()->json([
        'status' => 0,
        'message' => 'Failed to use OAuth token',
        'error' => $response->json()
    ], $response->status());
}

       
    
}


