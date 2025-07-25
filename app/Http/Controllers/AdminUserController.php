<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Update user admin status
     */
    public function updateAdminStatus(Request $request, User $user)
    {
        $validated = $request->validate([
            'is_admin' => 'required|boolean',
        ]);

        $user->is_admin = $validated['is_admin'];
        $user->save();

        // API request
        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'User admin status updated successfully',
                'user' => $user
            ]);
        }

        // Web request
        return back()->with('success', 'User admin status updated successfully');
    }
}