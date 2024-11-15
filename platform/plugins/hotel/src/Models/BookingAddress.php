<?php

namespace Botble\Hotel\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingAddress extends BaseModel
{
    protected $table = 'ht_booking_addresses';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'country',
        'state',
        'city',
        'address',
        'zip',
        'booking_id',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'first_name' => SafeContent::class,
        'last_name' => SafeContent::class,
        'phone' => SafeContent::class,
        'email' => SafeContent::class,
        'country' => SafeContent::class,
        'state' => SafeContent::class,
        'city' => SafeContent::class,
        'address' => SafeContent::class,
        'zip' => SafeContent::class,
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class)->withDefault();
    }

    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) =>
                ($attributes['address'] ? $attributes['address'] . ', ' : null)
                . ($attributes['city'] ? $attributes['city'] . ', ' : null)
                . ($attributes['state'] ? $attributes['state'] . ', ' : null)
                . ($attributes['country'] ? $attributes['country'] . ', ' : null)
                . ($attributes['zip'] ? $attributes['zip'] . ', ' : null)
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::get(fn () => sprintf('%s %s', $this->first_name, $this->last_name));
    }
}
