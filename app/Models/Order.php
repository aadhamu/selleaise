<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'subtotal',
        'shipping',
        'total',
        'status',
        'payment_method',
        'billing_address',
        'shipping_address',
        'payment_receipt',
        'payment_status',
    ];

    protected $casts = [
        'billing_address' => 'array',
        'shipping_address' => 'array',
    ];

    // Status constants
    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_FAILED = 'failed';
    
    public static function paymentStatusOptions()
    {
        return [
            self::PAYMENT_STATUS_PENDING => 'Pending',
            self::PAYMENT_STATUS_PAID => 'Paid',
            self::PAYMENT_STATUS_FAILED => 'Failed',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Customer',
            'email' => 'guest@example.com'
        ]);
    }

    public function getFormattedBillingAddressAttribute()
    {
        return $this->formatAddress($this->billing_address);
    }

    public function getFormattedShippingAddressAttribute()
    {
        return $this->shipping_address 
            ? $this->formatAddress($this->shipping_address)
            : 'Same as billing address';
    }

    protected function formatAddress(array $address): string
    {
        return implode(', ', array_filter([
            $address['first_name'] ?? null,
            $address['last_name'] ?? null,
            $address['address1'] ?? null,
            $address['address2'] ?? null,
            $address['city'] ?? null,
            $address['state'] ?? null,
            $address['zip'] ?? null,
            $address['country'] ?? null,
        ]));
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = 'ORD-' . strtoupper(uniqid());
        });
    }

    public function getFirstNameAttribute()
    {
        return $this->billing_address['first_name'] ?? null;
    }

    public function getLastNameAttribute()
    {
        return $this->billing_address['last_name'] ?? null;
    }

    public function getEmailAttribute()
    {
        return $this->billing_address['email'] ?? null;
    }

    public function getPhoneAttribute()
    {
        return $this->billing_address['phone'] ?? null;
    }

    public function getAddress1Attribute()
    {
        return $this->billing_address['address1'] ?? null;
    }

    public function getAddress2Attribute()
    {
        return $this->billing_address['address2'] ?? null;
    }

    public function getCityAttribute()
    {
        return $this->billing_address['city'] ?? null;
    }

    public function getStateAttribute()
    {
        return $this->billing_address['state'] ?? null;
    }

    public function getZipAttribute()
    {
        return $this->billing_address['zip'] ?? null;
    }

    public function getCountryAttribute()
    {
        return $this->billing_address['country'] ?? null;
    }
}



 
