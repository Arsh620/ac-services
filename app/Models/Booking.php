<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'assigned_to',
        'service_type',
        'service_price',
        'payment_status',
        'payment_method',
        'booking_date',
        'booking_time',
        'address',
        'status'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function assignedEmployee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
