<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class BookingAssignmentController extends Controller
{
    public function assign($bookingId, $employeeId)
    {
        $booking = Booking::findOrFail($bookingId);
        $employee = User::where('is_employee', 1)->findOrFail($employeeId);
        
        $booking->update([
            'assigned_to' => $employee->id,
            'status' => 'Confirmed'
        ]);
        
        return back()->with('success', 'Booking assigned successfully');
    }
    
    public function unassign($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        
        $booking->update([
            'assigned_to' => null,
            'status' => 'Pending'
        ]);
        
        return back()->with('success', 'Booking unassigned successfully');
    }
}