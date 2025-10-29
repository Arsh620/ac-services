# Payment System Maintenance Guide

## Quick Fix for Razorpay Issues

### 1. Check Configuration
Run this command to verify your Razorpay setup:
```bash
php artisan payment:check-config
```

### 2. Common Issues & Solutions

#### Issue: "Authentication key was missing during initialization"
**Solution:**
1. Check your `.env` file has these values:
```
RAZORPAY_KEY_ID=rzp_test_VZudIP0WpD4c6w
RAZORPAY_KEY_SECRET=your_secret_key_here
```

2. Clear config cache:
```bash
php artisan config:clear
php artisan cache:clear
```

3. Restart your server

#### Issue: Payment order creation fails
**Solution:**
1. Verify Razorpay credentials are correct
2. Check internet connection
3. Ensure booking amount is valid (> 0)

### 3. Testing Payment Flow

#### Test Online Payment:
1. Create a booking
2. Select "Online Payment"
3. Check logs: `storage/logs/laravel.log`
4. Look for "Razorpay order created successfully"

#### Debug Mode:
Add this to your `.env` for detailed logging:
```
LOG_LEVEL=debug
```

### 4. Maintenance Commands

#### Check payment configuration:
```bash
php artisan payment:check-config
```

#### Clear all caches:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### 5. Error Monitoring

Check these log entries for issues:
- `Razorpay API initialization`
- `Payment process started`
- `Razorpay order created successfully`
- `Payment verification failed`

### 6. Quick Troubleshooting Checklist

- [ ] Razorpay keys are in `.env` file
- [ ] Config cache is cleared
- [ ] Internet connection is working
- [ ] Booking amount is greater than 0
- [ ] No syntax errors in PaymentController
- [ ] Razorpay package is installed: `composer show razorpay/razorpay`

### 7. Emergency Fallback

If online payments fail, users can still use:
- Cash payment option
- Card payment option (offline)

Both will mark the booking as paid without requiring Razorpay.