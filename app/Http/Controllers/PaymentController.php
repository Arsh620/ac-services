<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    private function getRazorpayApi()
    {
        $keyId = env('RAZORPAY_KEY_ID');
        $keySecret = env('RAZORPAY_KEY_SECRET');
        
        if (empty($keyId) || empty($keySecret)) {
            \Log::error('Razorpay keys missing', ['key_id' => $keyId, 'secret' => $keySecret ? 'present' : 'missing']);
            throw new \Exception('Razorpay keys not configured properly');
        }
        
        return new Api($keyId, $keySecret);
    }
    
    public function show(Booking $booking)
    {
        return view('payments.show', compact('booking'));
    }
    
    public function process(Request $request, Booking $booking)
    {
        \Log::info('Process method called', ['booking_id' => $booking->id, 'request_data' => $request->all()]);
        
        $validated = $request->validate([
            'payment_method' => 'required|in:cash,card,online',
        ]);
        
        \Log::info('Payment method selected', ['method' => $validated['payment_method'], 'booking_id' => $booking->id]);
        
        if ($validated['payment_method'] === 'online') {
            \Log::info('Redirecting to Razorpay order creation');
            $url = route('payments.razorpay', $booking);
            \Log::info('Redirect URL', ['url' => $url]);
            return redirect($url);
        }
        
        // Process offline payments (cash/card)
        $transactionId = 'TXN' . time() . rand(1000, 9999);
        
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->service_price,
            'payment_method' => $validated['payment_method'],
            'transaction_id' => $transactionId,
            'status' => 'completed'
        ]);
        
        $booking->update(['payment_status' => 'paid']);
        
        return redirect()->route('payments.receipt', $payment)->with('success', 'Payment completed successfully!');
    }
    
    public function razorpay(Booking $booking)
    {
        \Log::info('Razorpay method called', ['booking_id' => $booking->id]);
        
        try {
            $keyId = env('RAZORPAY_KEY_ID');
            $keySecret = env('RAZORPAY_KEY_SECRET');
            
            if (empty($keyId) || empty($keySecret)) {
                \Log::error('Razorpay keys missing in razorpay method');
                return back()->with('error', 'Payment configuration error');
            }
            
            // Debug: Check booking details
            \Log::info('Booking details', ['id' => $booking->id, 'service_price' => $booking->service_price]);
            
            // Ensure amount is valid
            $amount = (float)$booking->service_price * 100;
            if ($amount <= 0) {
                \Log::error('Invalid amount', ['service_price' => $booking->service_price, 'calculated_amount' => $amount]);
                return back()->with('error', 'Invalid booking amount: $' . $booking->service_price);
            }
            
            $razorpay = $this->getRazorpayApi();
            $order = $razorpay->order->create([
                'amount' => $amount, // Amount in paise
                'currency' => 'INR',
                'receipt' => 'booking_' . $booking->id . '_' . time(),
                'payment_capture' => 1
            ]);
            
            // Debug: Log order creation
            \Log::info('Razorpay order created', ['order_id' => $order['id'], 'amount' => $amount]);
            
            $razorpayKey = $keyId;
            return view('payments.razorpay', compact('booking', 'order', 'razorpayKey'));
            
        } catch (\Exception $e) {
            \Log::error('Razorpay order creation failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Payment order creation failed: ' . $e->getMessage());
        }
    }
    
    // **HIGHLIGHTED:** New method to verify Razorpay payment
    public function verifyRazorpay(Request $request)
    {
        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];
            
            $razorpay = $this->getRazorpayApi();
            $razorpay->utility->verifyPaymentSignature($attributes);
            
            $booking = Booking::find($request->booking_id);
            
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'amount' => $booking->service_price,
                'payment_method' => 'online',
                'transaction_id' => $request->razorpay_payment_id,
                'status' => 'completed'
            ]);
            
            $booking->update(['payment_status' => 'paid']);
            
            return redirect()->route('payments.receipt', $payment)->with('success', 'Online payment completed successfully!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }
    
    public function receipt(Payment $payment)
    {
        return view('payments.receipt', compact('payment'));
    }
}