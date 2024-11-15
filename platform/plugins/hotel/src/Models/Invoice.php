<?php

namespace Botble\Hotel\Models;

use Botble\Base\Models\BaseModel;
use Botble\Hotel\Enums\InvoiceStatusEnum;
use Botble\Payment\Models\Payment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Invoice extends BaseModel
{
    protected $table = 'ht_invoices';

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'description',
        'payment_id',
        'reference_type',
        'reference_id',
        'code',
        'tax_amount',
        'discount_amount',
        'amount',
        'sub_total',
        'status',
        'paid_at',
        'coupon_code',
    ];

    protected $casts = [
        'sub_total' => 'float',
        'tax_amount' => 'float',
        'discount_amount' => 'float',
        'amount' => 'float',
        'status' => InvoiceStatusEnum::class,
        'paid_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Invoice $invoice) {
            $code = self::generateInvoiceCode();

            $invoice->code = $code;
        });
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public static function generateInvoiceCode(): string
    {
        $prefix = setting('hotel_invoice_code_prefix', 'INV-');
        $nextId = static::query()->max('id') + 1;

        do {
            $code = sprintf('%s%d', $prefix, $nextId);
            $nextId++;
        } while (static::query()->where('code', $code)->exists());

        return $code;
    }
}
