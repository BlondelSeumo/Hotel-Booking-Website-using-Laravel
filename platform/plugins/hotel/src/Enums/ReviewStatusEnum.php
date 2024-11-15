<?php

namespace Botble\Hotel\Enums;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

/**
 * @method static ReviewStatusEnum PENDING()
 * @method static ReviewStatusEnum APPROVED()
 * @method static ReviewStatusEnum REJECTED()
 */
class ReviewStatusEnum extends Enum
{
    public const PENDING = 'pending';
    public const APPROVED = 'approved';
    public const REJECTED = 'rejected';

    public static $langPath = 'plugins/hotel::review.moderation-statuses';

    public function toHtml(): HtmlString|string|null
    {
        $color = match ($this->value) {
            self::APPROVED => 'success',
            self::PENDING => 'warning',
            self::REJECTED => 'danger',
            default => 'primary',
        };

        return BaseHelper::renderBadge($this->label(), $color);
    }
}
