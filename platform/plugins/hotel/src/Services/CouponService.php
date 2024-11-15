<?php

namespace Botble\Hotel\Services;

use Botble\Base\Models\BaseModel;
use Botble\Hotel\Enums\CouponTypeEnum;
use Botble\Hotel\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CouponService
{
    public function getCouponByCode(string $code): BaseModel|Model|null
    {
        return Coupon::query()
            ->where('code', $code)
            ->where(function (Builder $query) {
                $query->whereNull('expires_date')
                    ->orWhere('expires_date', '>=', Carbon::now());
            })
            ->where(function (Builder $query) {
                $query->whereNull('quantity')
                    ->orWhereColumn('quantity', '>', 'total_used');
            })
            ->first();
    }

    public function getDiscountAmount(string $type, float $value, float $amountTotal = 0): float
    {
        return match ($type) {
            CouponTypeEnum::PERCENTAGE => $value / 100 * $amountTotal,
            CouponTypeEnum::FIXED => $value,
            default => 0,
        };
    }
}
