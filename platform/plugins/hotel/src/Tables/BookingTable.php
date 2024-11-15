<?php

namespace Botble\Hotel\Tables;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\Hotel\Enums\BookingStatusEnum;
use Botble\Hotel\Models\Booking;
use Botble\Hotel\Tables\Formatters\PriceFormatter;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\StatusColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\Relation as EloquentRelation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BookingTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Booking::class)
            ->addActions([
                EditAction::make()->route('booking.edit'),
                DeleteAction::make()->route('booking.destroy'),
            ]);
    }

    public function ajax(): JsonResponse
    {
        $data = $this->table
            ->eloquent($this->query())
            ->formatColumn('amount', PriceFormatter::class)
            ->editColumn('customer_id', function (Booking $item) {
                return $item->address->id ? BaseHelper::clean(
                    $item->address->first_name . ' ' . $item->address->last_name
                ) : '&mdash;';
            })
            ->editColumn('room_id', function (Booking $item) {
                return $item->room->room->exists ? Html::link(
                    $item->room->room->url,
                    BaseHelper::clean($item->room->room->name),
                    ['target' => '_blank']
                ) : $item->room->room_name;
            })
            ->editColumn('booking_period', function (Booking $item) {
                return BaseHelper::formatDate($item->room->start_date) . ' -> ' . BaseHelper::formatDate(
                    $item->room->end_date
                );
            })
            ->filter(function ($query) {
                $keyword = $this->request->input('search.value');
                if ($keyword) {
                    return $query->whereHas('address', function ($subQuery) use ($keyword) {
                        return $subQuery
                            ->where('ht_booking_addresses.first_name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('ht_booking_addresses.last_name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere(
                                DB::raw('CONCAT(ht_booking_addresses.first_name, " ", ht_booking_addresses.last_name)'),
                                'LIKE',
                                '%' . $keyword . '%'
                            )
                            ->orWhere(
                                DB::raw('CONCAT(ht_booking_addresses.last_name, " ", ht_booking_addresses.first_name)'),
                                'LIKE',
                                '%' . $keyword . '%'
                            );
                    });
                }

                return $query;
            });

        if (! is_plugin_active('payment')) {
            $data = $data->removeColumn('payment_status')->removeColumn('payment_id');
        } else {
            $data = $data
                ->editColumn('payment_status', function (Booking $item) {
                    return $item->payment->status->label() ? BaseHelper::clean(
                        $item->payment->status->toHtml()
                    ) : '&mdash;';
                })
                ->editColumn('payment_id', function (Booking $item) {
                    return BaseHelper::clean($item->payment->payment_channel->label() ?: '&mdash;');
                });
        }

        return $this->toJson($data);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this
            ->getModel()
            ->query()
            ->select([
                'id',
                'created_at',
                'status',
                'amount',
                'payment_id',
            ])
            ->with(['address', 'room']);

        if (is_plugin_active('payment')) {
            $query->with('payment');
        }

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        $columns = [
                IdColumn::make(),
                Column::make('customer_id')
                    ->title(trans('plugins/hotel::booking.customer'))
                    ->alignLeft()
                    ->orderable(false)
                    ->searchable(false),
                Column::make('room_id')
                    ->title(trans('plugins/hotel::booking.room'))
                    ->alignLeft()
                    ->orderable(false)
                    ->searchable(false),
                Column::formatted('amount')
                    ->title(trans('plugins/hotel::booking.amount'))
                    ->alignLeft(),
                Column::make('booking_period')
                    ->title(trans('plugins/hotel::booking.booking_period'))
                    ->orderable(false)
                    ->searchable(false)
                    ->alignLeft(),
                CreatedAtColumn::make(),
            ];

        if (is_plugin_active('payment')) {
            $columns = array_merge($columns, [
                Column::make('payment_id')
                    ->name('payment_id')
                    ->title(trans('plugins/hotel::booking.payment_method'))
                    ->alignLeft()
                    ->orderable(false)
                    ->searchable(false),
                Column::make('payment_status')
                    ->name('payment_id')
                    ->title(trans('plugins/hotel::booking.payment_status_label'))
                    ->orderable(false)
                    ->searchable(false),
            ]);
        }

        return array_merge($columns, [
            StatusColumn::make(),
        ]);
    }

    public function bulkActions(): array
    {
        return [
            DeleteBulkAction::make()->permission('booking.destroy'),
        ];
    }

    public function getBulkChanges(): array
    {
        $options = [
            'status' => [
                'title' => trans('core/base::tables.status'),
                'type' => 'select',
                'choices' => BookingStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BookingStatusEnum::values()),
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type' => 'datePicker',
            ],
        ];

        if (is_plugin_active('payment')) {
            $options['payment_status'] = [
                'title' => trans('plugins/hotel::booking.payment_status_label'),
                'type' => 'select',
                'choices' => PaymentStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', PaymentStatusEnum::values()),
            ];
        }

        return $options;
    }

    public function applyFilterCondition(
        EloquentBuilder|QueryBuilder|EloquentRelation $query,
        string $key,
        string $operator,
        ?string $value
    ): EloquentRelation|EloquentBuilder|QueryBuilder {
        if ($key === 'payment_status') {
            return $query->whereHas('payment', function ($query) use ($value) {
                return $query->where('status', $value);
            });
        }

        return parent::applyFilterCondition($query, $key, $operator, $value);
    }

    public function saveBulkChangeItem(Model|Booking $item, string $inputKey, ?string $inputValue): Model|bool
    {
        if ($inputKey === 'payment_status' && $item instanceof Booking) {
            $item->payment()->update(['status' => $inputValue]);

            return $item;
        }

        return parent::saveBulkChangeItem($item, $inputKey, $inputValue);
    }
}
