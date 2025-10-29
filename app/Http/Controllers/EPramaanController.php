<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\EPramaanService;
use App\Models\User;

class EPramaanController extends Controller
{
    protected $service;

    public function __construct(EPramaanService $service)
    {
        $this->service = $service;
    }

    // Step 1: Get login URL
    public function redirectToEPramaan()
    {
        $redirectUrl = route('api.epramaan.callback'); // callback URL
        return response()->json([
            'login_url' => $this->service->getLoginUrl($redirectUrl)
        ]);
    }

    // Web-based redirect to ePramaan
    public function webRedirectToEPramaan()
    {
        // Check if using demo credentials
        if (config('epramaan.client_id') === 'your_client_id') {
            // Demo mode - simulate successful login
            return $this->demoLogin();
        }
        
        $redirectUrl = route('epramaan.web.callback');
        $loginUrl = $this->service->getLoginUrl($redirectUrl);
        return redirect($loginUrl);
    }
    
    // Demo login for testing
    private function demoLogin()
    {
        $user = User::updateOrCreate(
            ['email' => 'demo@epramaan.gov.in'],
            ['name' => 'ePramaan Demo User']
        );
        
        Auth::login($user);
        return redirect()->route('school.dashboard')->with('success', 'Demo login successful (ePramaan simulation)');
    }

    // Step 2: Handle callback
    public function handleCallback(Request $request)
    {
        $code = $request->get('code');
        if (!$code) {
            return response()->json(['error' => 'Authorization code missing'], 400);
        }

        $tokenData = $this->service->getAccessToken($code, route('api.epramaan.callback'));

        $userInfo = $tokenData['user_info'] ?? null;

        if ($userInfo) {
            $user = User::updateOrCreate(
                ['email' => $userInfo['email']],
                ['name' => $userInfo['name']]
            );

            // Generate API token for frontend/mobile
            $token = $user->createToken('epramaan_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
                'token_data' => $tokenData
            ]);
        }

        return response()->json(['error' => 'Login failed'], 401);
    }

    // Web-based callback handler
    public function webHandleCallback(Request $request)
    {
        $code = $request->get('code');
        if (!$code) {
            return redirect()->route('school.login')->with('error', 'Authorization code missing');
        }

        try {
            $tokenData = $this->service->getAccessToken($code, route('epramaan.web.callback'));
            $userInfo = $tokenData['user_info'] ?? null;

            if ($userInfo) {
                $user = User::updateOrCreate(
                    ['email' => $userInfo['email']],
                    ['name' => $userInfo['name']]
                );

                Auth::login($user);
                return redirect()->route('school.dashboard')->with('success', 'Login successful via ePramaan');
            }
        } catch (\Exception $e) {
            return redirect()->route('school.login')->with('error', 'ePramaan authentication failed: ' . $e->getMessage());
        }

        return redirect()->route('school.login')->with('error', 'Login failed');
    }
}
