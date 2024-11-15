<?php

namespace Botble\Hotel\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Hotel\Enums\BookingStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingRoom extends BaseModel
{
    protected $table = 'ht_booking_rooms';

    protected $fillable = [
        'booking_id',
        'room_id',
        'room_name',
        'room_image',
        'price',
        'currency_id',
        'number_of_rooms',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id')->withDefault();
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id')->withDefault();
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id')->withDefault();
    }

    public function scopeActive($query)
    {
        return $query
            ->join('ht_bookings', 'ht_bookings.id', '=', $this->table . '.booking_id')
            ->whereNotIn('ht_bookings.status', [BookingStatusEnum::CANCELLED]);
    }

    public function scopeInRange($query, $startDate, $endDate)
    {
        return $query
            ->where('start_date', '<=', $endDate)
            ->where('end_date', '>', $startDate);
    }

    protected function bookingPeriod(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['start_date'] . ' -> ' . $attributes['end_date'],
        );
    }
}
