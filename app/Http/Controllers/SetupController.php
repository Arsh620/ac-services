<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('setup.index', compact('users'));
    }
    
    public function makeAdmin(User $user)
    {
        $user->is_admin = 1;
        $user->save();
        
        return back()->with('success', "User {$user->name} is now an admin");
    }
    
    public function removeAdmin(User $user)
    {
        $user->is_admin = 0;
        $user->save();
        
        return back()->with('success', "Admin privileges removed from {$user->name}");
    }
}