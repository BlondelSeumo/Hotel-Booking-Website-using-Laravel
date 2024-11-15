<?php

namespace Botble\Hotel\Tables;

use Botble\Base\Facades\Html;
use Botble\Hotel\Enums\CouponTypeEnum;
use Botble\Hotel\Models\Coupon;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\StatusColumn;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CouponTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Coupon::class)
            ->addActions([
                EditAction::make()->route('coupons.edit'),
                DeleteAction::make()->route('coupons.destroy'),
            ]);
    }

    public function ajax(): JsonResponse
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('code', function (Coupon $coupon) {
                $value = $coupon->type == CouponTypeEnum::PERCENTAGE()->getValue()
                    ? number_format($coupon->value) . '%'
                    : format_price($coupon->value);

                return view(
                    'plugins/hotel::coupons.partials.detail',
                    compact('coupon', 'value')
                )->render();
            })
            ->editColumn('expires_date', function (Coupon $coupon) {
                if (! $coupon->expires_date) {
                    return '&mdash;';
                }

                return $coupon->expires_date;
            })
            ->editColumn('status', function (Coupon $coupon) {
                if ($coupon->expires_date !== null && Carbon::now()->gt($coupon->expires_date)) {
                    return Html::tag('span', trans('plugins/hotel::coupon.expired'), [
                        'class' => 'status-label label-default',
                    ]);
                }

                return Html::tag('span', trans('plugins/hotel::coupon.active'), [
                    'class' => 'status-label label-success',
                ]);
            });

        return $this->toJson($data);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this->getModel()->query()->select(['*']);

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            Column::make('code')
                ->title(trans('plugins/hotel::coupon.coupon_code'))
                ->alignLeft(),
            Column::make('total_used')
                ->title(trans('plugins/hotel::coupon.total_used'))
                ->alignLeft(),
            Column::make('expires_date')
                ->title(trans('plugins/hotel::coupon.expires_date'))
                ->alignLeft(),
            StatusColumn::make(),
        ];
    }

    public function buttons(): array
    {
        return $this->addCreateButton(route('coupons.create'), 'coupons.create');
    }

    public function bulkActions(): array
    {
        return [
            DeleteBulkAction::make()->permission('coupons.destroy'),
        ];
    }

    public function renderTable($data = [], $mergeData = []): View|Factory|Response
    {
        if ($this->isEmpty()) {
            return view('plugins/hotel::coupons.intro');
        }

        return parent::renderTable($data, $mergeData);
    }
}
