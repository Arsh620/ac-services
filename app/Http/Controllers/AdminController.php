<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function users(Request $request)
    {
        $users = User::all();
        
        // API request
        if ($request->is('api/*')) {
            return response()->json([
                'data' => $users
            ]);
        }
        
        // Web request
        return view('admin.users');
    }
    public function dashboard(Request $request)
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'Pending')->count();
        $completedBookings = Booking::where('status', 'Completed')->count();
        $totalUsers = User::count();
        
        // API request
        if ($request->is('api/*')) {
            return response()->json([
                'data' => [
                    'total_bookings' => $totalBookings,
                    'pending_bookings' => $pendingBookings,
                    'completed_bookings' => $completedBookings,
                    'total_users' => $totalUsers
                ]
            ]);
        }
        
        // Web request
        return view('admin.dashboard', compact('totalBookings', 'pendingBookings', 'completedBookings', 'totalUsers'));
    }
    
    public function bookings(Request $request)
    {
        $bookings = Booking::with('user')->latest()->get();
        
        // API request
        if ($request->is('api/*')) {
            return response()->json([
                'data' => $bookings
            ]);
        }
        
        // Web request
        return view('admin.bookings', compact('bookings'));
    }
    
    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
        ]);
        
        $booking->status = $validated['status'];
        $booking->save();
        
        // API request
        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'Booking status updated successfully',
                'data' => $booking
            ]);
        }
        
        // Web request
        return back()->with('success', 'Booking status updated successfully');
    }
}