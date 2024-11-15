<?php

namespace Botble\Hotel\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Hotel\Enums\ServicePriceTypeEnum;

class Service extends BaseModel
{
    protected $table = 'ht_services';

    protected $fillable = [
        'name',
        'description',
        'content',
        'price',
        'price_type',
        'image',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'description' => SafeContent::class,
        'content' => SafeContent::class,
        'price_type' => ServicePriceTypeEnum::class,
    ];
}
