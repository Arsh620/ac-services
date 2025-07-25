<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::where('user_id', Auth::id())->latest()->get();
        
        // API request
        if ($request->is('api/*')) {
            return response()->json([
                'data' => $bookings
            ]);
        }
        
        // Web request
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_type' => 'required|string',
            'service_price' => 'required|numeric|min:0',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'address' => 'required|string',
        ]);

        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->service_type = $validated['service_type'];
        $booking->service_price = $validated['service_price'];
        $booking->payment_status = 'pending';
        $booking->booking_date = $validated['booking_date'];
        $booking->booking_time = $validated['booking_time'];
        $booking->address = $validated['address'];
        $booking->save();

        // API request
        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'Booking created successfully',
                'data' => $booking
            ], 201);
        }
        
        // Web request
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
    }

    public function show(Request $request, Booking $booking)
    {
        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            if ($request->is('api/*')) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            abort(403);
        }
        
        // API request
        if ($request->is('api/*')) {
            return response()->json([
                'data' => $booking
            ]);
        }
        
        // Web request
        return view('bookings.show', compact('booking'));
    }
}