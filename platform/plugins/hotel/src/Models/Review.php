<?php

namespace Botble\Hotel\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;
use Botble\Hotel\Enums\ReviewStatusEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends BaseModel
{
    protected $table = 'ht_room_reviews';

    protected $fillable = [
        'customer_id',
        'room_id',
        'star',
        'content',
        'status',
    ];

    protected $casts = [
        'star' => 'int',
        'status' => ReviewStatusEnum::class,
        'content' => SafeContent::class,
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id')->withDefault();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id')->withDefault();
    }
}
