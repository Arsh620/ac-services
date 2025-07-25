<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // For API routes, always treat as JSON request
        $isApiRequest = $request->is('api/*') || $request->expectsJson() || $request->wantsJson() || 
                       $request->header('Accept') == 'application/json';

        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile' => ['nullable', 'string', 'max:15'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            if ($isApiRequest) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        // For web requests, log the user in
        if (!$isApiRequest) {
            Auth::login($user);
        }

        // API request
        if ($isApiRequest) {
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user' => $user
            ], 201);
        }
        
        // Web request
        return redirect('/');
    }
}