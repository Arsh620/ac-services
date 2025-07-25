<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('payments.show', compact('booking'));
    }

    public function process(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'payment_method' => 'required|in:cash,card,online'
        ]);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->service_price,
            'payment_method' => $request->payment_method,
            'transaction_id' => 'TXN-' . strtoupper(Str::random(10)),
            'status' => 'completed'
        ]);

        $booking->update(['payment_status' => 'paid']);

        return redirect()->route('payments.receipt', $payment)->with('success', 'Payment completed successfully!');
    }

    public function receipt(Payment $payment)
    {
        if ($payment->booking->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('payments.receipt', compact('payment'));
    }
}