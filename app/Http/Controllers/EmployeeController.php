<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('is_employee', 1)->get();
        return view('admin.employees.index', compact('employees'));
    }
    
    public function create()
    {
        return view('admin.employees.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'position' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'skills' => 'nullable|string',
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_employee' => true,
            'position' => $validated['position'],
            'phone' => $validated['phone'],
            'skills' => $validated['skills'],
        ]);
        
        return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully');
    }
    
    public function edit(User $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }
    
    public function update(Request $request, User $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $employee->id,
            'position' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'skills' => 'nullable|string',
        ]);
        
        $employee->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'position' => $validated['position'],
            'phone' => $validated['phone'],
            'skills' => $validated['skills'],
        ]);
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8',
            ]);
            
            $employee->update([
                'password' => Hash::make($request->password),
            ]);
        }
        
        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully');
    }
    
    public function destroy(User $employee)
    {
        $employee->update(['is_employee' => false]);
        return redirect()->route('admin.employees.index')->with('success', 'Employee removed successfully');
    }
    
    public function assignBookings(User $employee)
    {
        // Get all bookings that are not assigned to any employee
        $pendingBookings = Booking::whereNull('assigned_to')->get();
        $assignedBookings = Booking::where('assigned_to', $employee->id)->get();
        
        return view('admin.employees.assign', compact('employee', 'pendingBookings', 'assignedBookings'));
    }
}