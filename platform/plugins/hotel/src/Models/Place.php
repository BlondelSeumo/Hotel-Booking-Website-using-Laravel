<?php

namespace Botble\Hotel\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class Place extends BaseModel
{
    protected $table = 'ht_places';

    protected $fillable = [
        'name',
        'distance',
        'description',
        'content',
        'image',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'distance' => SafeContent::class,
        'description' => SafeContent::class,
        'content' => SafeContent::class,
    ];
}
