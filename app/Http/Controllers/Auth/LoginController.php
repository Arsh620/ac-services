<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // For API routes, always treat as JSON request
        $isApiRequest = $request->is('api/*') || $request->expectsJson() || $request->wantsJson() || 
                       $request->header('Accept') == 'application/json';

        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
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

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // API request - return token
            if ($isApiRequest) {
                $user = Auth::user();
                $token = $user->createToken('auth-token')->plainTextToken;
                return response()->json([
                    'token' => $token,
                    'user' => $user
                ]);
            }
            
            // Web request - use session
            $request->session()->regenerate();
            
            // Redirect based on user role
            if (Auth::user()->is_admin) {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(route('dashboard'));
            }
        }

        // API error response
        if ($isApiRequest) {
            return response()->json([
                'message' => 'Invalid credentials',
                'errors' => [
                    'email' => ['The provided credentials are incorrect.']
                ]
            ], 401);
        }
        
        // Web error response
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // API request - revoke token
        if ($request->wantsJson() || $request->is('api/*')) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        }
        
        // Web request - invalidate session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}