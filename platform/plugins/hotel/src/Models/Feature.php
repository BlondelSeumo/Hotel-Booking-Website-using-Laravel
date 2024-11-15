<?php

namespace Botble\Hotel\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class Feature extends BaseModel
{
    protected $table = 'ht_features';

    protected $fillable = [
        'name',
        'description',
        'icon',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'description' => SafeContent::class,
        'icon' => SafeContent::class,
    ];
}
