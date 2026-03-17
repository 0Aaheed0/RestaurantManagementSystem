# Payment System & Checkout Flow Documentation

## Overview
A complete payment procedure has been implemented for the Restaurant Management System with the following features:
- **Shopping Cart → Checkout → Payment Processing**
- **Voucher Support** (Percentage & Fixed Discounts)
- **Multiple Payment Methods** (Card, Mobile Banking, Cash on Delivery)
- **Order Tracking** with discounts applied

---

## System Flow

### 1. **Cart Page** (`/cart`)
- View items in cart
- Remove items
- See total amount
- **Checkout Button** → Takes user to checkout page

### 2. **Checkout Page** (`/checkout`) - NEW
- View order summary with all items
- **Apply Voucher Code** (Optional)
- Select payment method
- Review final price with discount applied
- Process payment

### 3. **Payment Success Page** - NEW
- Confirmation of successful order
- Display order details
- Show voucher discount applied (if any)
- Links to view orders or order more food

---

## New Features Implemented

### Database Changes
✅ Added migration: `2026_03_17_add_voucher_to_orders`
- `voucher_id` - Foreign key to vouchers table
- `discount_amount` - Amount discounted in BDT
- `final_price` - Price after discount applied

### Models Updated
✅ **Order Model** (`app/Models/Order.php`)
```php
// New relationship
public function voucher()
{
    return $this->belongsTo(Voucher::class);
}

// Updated fillable
protected $fillable = ['user_id','total_price','status','voucher_id','discount_amount','final_price'];
```

### Controller Changes
✅ **OrderController** (`app/Http/Controllers/OrderController.php`)

**New Methods:**
1. `showCheckout()` - Display checkout page with cart and voucher options
2. `applyVoucher()` - Validate and apply voucher code to session
3. `removeVoucher()` - Remove applied voucher from session
4. `processPayment()` - Process payment and create order with discount
5. `isVoucherValid()` - Check voucher expiry and usage limits
6. `calculateDiscount()` - Calculate discount amount (percentage or fixed)

### Routes Added
✅ `routes/web.php`
```php
Route::get('/checkout', [OrderController::class,'showCheckout'])->name('checkout');
Route::post('/checkout/apply-voucher', [OrderController::class,'applyVoucher'])->name('checkout.apply-voucher');
Route::post('/checkout/remove-voucher', [OrderController::class,'removeVoucher'])->name('checkout.remove-voucher');
Route::post('/checkout/process', [OrderController::class,'processPayment'])->name('checkout.process');
```

### Views Created/Updated

#### ✅ **checkout.blade.php** (NEW)
- Beautiful glassmorphic design
- Two-column layout:
  - **Left**: Order summary with items list and pricing breakdown
  - **Right**: Payment section with voucher input and payment method selection
- Features:
  - Real-time discount calculation display
  - Voucher code input with validation messages
  - Remove applied voucher option
  - Three payment methods with icons:
    - Credit/Debit Card
    - Mobile Banking (bKash/Nagad)
    - Cash on Delivery
  - Responsive design for mobile devices

#### ✅ **payment_success.blade.php** (NEW)
- Success confirmation page with checkmark animation
- Order details display:
  - Order ID
  - Order date & time
  - Payment method
  - Item count
  - Subtotal, discount, and final price
  - Status badge (typically "Pending Preparation")
- Action buttons:
  - View Orders
  - Order More Food

#### ✅ **cart.blade.php** (UPDATED)
- Changed checkout button from POST to GET
- Now links to `/checkout` page instead of direct processing

#### ✅ **orders_history.blade.php** (UPDATED)
- Added discount information column
- Shows voucher code applied
- Displays final price after discount
- Enhanced with color-coding for discounts

---

## Available Vouchers

The following vouchers have been seeded and are ready to use:

| Code | Type | Discount | Valid Until | Max Uses |
|------|------|----------|-------------|----------|
| WELCOME10 | Percentage | 10% | 3 months | 100 |
| FLAT50 | Fixed | ৳50 | 2 months | 50 |
| SPRING20 | Percentage | 20% | 1 month | 200 |

---

## Voucher Logic

### Validation Rules
✅ Code must exist in database
✅ Must not be expired (`valid_until >= now()`)
✅ Must have remaining uses (`uses < max_uses`)

### Discount Calculation
```
For Percentage Discount:
  discount = (subtotal × discount_percentage) / 100

For Fixed Discount:
  discount = min(fixed_amount, subtotal)
  (prevents negative totals)
```

### Usage Tracking
- **uses** field increments when order is placed
- Prevents voucher reuse beyond `max_uses` limit
- Can be reset by admin if needed

---

## Payment Processing Flow

1. **User adds items to cart** → `/cart`
2. **Clicks "Proceed to Checkout"** → `/checkout` (GET)
3. **Can optionally:**
   - Enter voucher code
   - System validates and applies discount
   - Can remove voucher before proceeding
4. **Selects payment method:**
   - Card payment
   - Mobile banking
   - Cash on delivery
5. **Submits payment form** → `/checkout/process` (POST)
6. **System:**
   - Validates voucher again (if applied)
   - Increments voucher uses
   - Creates Order record with discount
   - Creates OrderItem records
   - Clears cart
   - Shows success page
7. **User can:**
   - View order details
   - Continue shopping
   - Access order history

---

## Session Management

Voucher applied via session: `applied_voucher_id`
- Cleared after checkout completion
- Cleared if voucher becomes invalid
- Preserved during checkout journey (until payment or removal)

---

## Error Handling

✅ Invalid voucher code → Error message with guidance
✅ Expired voucher → Error message with expiry details
✅ Exceeded usage limits → Error message
✅ Empty cart at checkout → Redirect to cart with error
✅ Validation errors → Highlighted with user-friendly messages

---

## Security Features

✅ CSRF protection on all forms
✅ Database foreign key constraints
✅ Voucher validation on every step
✅ Authorization checks (user can only see own orders)
✅ Payment method validation

---

## Testing the System

### Step 1: Add items to cart
- Go to `/food`
- Add items with quantities
- Go to `/cart`

### Step 2: Proceed to checkout
- Click "Proceed to Checkout"
- Should land on `/checkout`

### Step 3: Apply voucher
- Enter voucher code: `WELCOME10`, `FLAT50`, or `SPRING20`
- Click "Apply"
- Should see discount applied in real-time

### Step 4: Complete payment
- Select a payment method
- Click "Complete Payment"
- Should see success page with order details and discount shown

### Step 5: View orders
- Go to `/orders/history`
- Should see orders with discounts and voucher codes applied
- Final price should be less than original amount

---

## Database Schema

### Orders Table (Updated)
```sql
- id (PK)
- user_id (FK)
- total_price (decimal, 8,2) - Subtotal
- voucher_id (FK, nullable) - Applied voucher
- discount_amount (decimal, 8,2) - Discount in BDT
- final_price (decimal, 8,2) - Price after discount
- status (pending/completed/cancelled)
- timestamps
```

### Vouchers Table (Existing)
```sql
- id (PK)
- code (unique)
- discount (decimal)
- type (percentage/fixed)
- valid_until (timestamp)
- uses (integer) - Current usage count
- max_uses (integer) - Maximum allowed uses
- timestamps
```

---

## Implementation Details

### File Structure
```
app/
  ├── Http/Controllers/
  │   └── OrderController.php (UPDATED)
  ├── Models/
  │   └── Order.php (UPDATED with voucher relationship)
  
database/
  ├── migrations/
  │   └── 2026_03_17_add_voucher_to_orders.php (NEW)
  ├── seeders/
  │   └── VoucherSeeder.php (UPDATED - safe truncate)
  
resources/views/
  ├── checkout.blade.php (NEW)
  ├── payment_success.blade.php (NEW)
  ├── cart.blade.php (UPDATED)
  └── orders_history.blade.php (UPDATED)
  
routes/
  └── web.php (UPDATED with new checkout routes)
```

---

## Future Enhancements

### Can Add:
1. **Payment Gateway Integration**
   - Stripe, SSLCommerz, or other BD payment gateways
   - Real payment processing instead of placeholder

2. **Invoice Generation**
   - PDF invoices with order details
   - Email invoices to customer

3. **Admin Dashboard**
   - Manage vouchers (create, edit, deactivate)
   - View all orders
   - Track payment statuses

4. **Email Notifications**
   - Order confirmation email
   - Payment reminder
   - Delivery notification

5. **Refunds & Cancellations**
   - Allow users to cancel orders
   - Automatic voucher refund tracking

6. **Coupon Codes**
   - Bulk code generation
   - Tiered discounts based on amount
   - User-specific vouchers

---

## Important Notes

✅ **Database Migrated** - Run `php artisan migrate` (already done)
✅ **Vouchers Seeded** - Sample vouchers available
✅ **Responsive Design** - Works on mobile and desktop
✅ **User Authentication** - Requires user to be logged in
✅ **Order History** - Users can view all their orders with discounts

---

## Troubleshooting

**Issue**: Voucher not applying?
- Check if code is correct (case-insensitive)
- Verify voucher hasn't expired
- Check if max uses reached

**Issue**: Discount not showing?
- Refresh the checkout page
- Try removing and reapplying voucher
- Check browser console for errors

**Issue**: Payment button not working?
- Ensure cart is not empty
- Check form validation messages
- Verify JavaScript is enabled

---

**Implementation Date**: March 17, 2026
**Status**: ✅ Complete and Ready for Testing
