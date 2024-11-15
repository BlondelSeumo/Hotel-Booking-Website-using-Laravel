<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Facades\Assets;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Hotel\Enums\BookingStatusEnum;
use Botble\Hotel\Forms\RoomForm;
use Botble\Hotel\Http\Requests\RoomRequest;
use Botble\Hotel\Http\Requests\RoomUpdateOrderByRequest;
use Botble\Hotel\Models\Room;
use Botble\Hotel\Models\RoomDate;
use Botble\Hotel\Tables\RoomTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/hotel::hotel.name'))
            ->add(trans('plugins/hotel::room.name'), route('room.index'));
    }

    public function index(RoomTable $table)
    {
        $this->pageTitle(trans('plugins/hotel::room.name'));

        Assets::addScripts(['bootstrap-editable'])
            ->addStyles(['bootstrap-editable']);

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/hotel::room.create'));

        return RoomForm::create()->renderForm();
    }

    public function store(RoomRequest $request)
    {
        $form = RoomForm::create();
        $form->saving(function (RoomForm $form) use ($request) {
            $data = $request->validated();
            if ($images = $request->input('images', [])) {
                $data['images'] = json_encode(array_filter($images));
            }

            $form
                ->getModel()
                ->fill($data)
                ->save();

            if ($room = $form->getModel()) {
                $room->amenities()->sync($request->input('amenities', []));
            }
        });

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('room.index'))
            ->setNextUrl(route('room.edit', $form->getModel()->getKey()))
            ->withCreatedSuccessMessage();
    }

    public function edit(Room $room)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $room->name]));

        return RoomForm::createFromModel($room)->renderForm();
    }

    public function update(Room $room, RoomRequest $request)
    {
        RoomForm::createFromModel($room)
            ->saving(function (RoomForm $form) use ($request) {
                $data = $request->validated();
                if ($images = $request->input('images', [])) {
                    $data['images'] = json_encode(array_filter($images));
                }

                $model = $form->getModel();

                $model->fill($data)->save();

                $model->amenities()->sync($request->input('amenities', []));
            });

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('room.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Room $room)
    {
        return DeleteResourceAction::make($room);
    }

    public function getRoomAvailability(int|string $id, Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $startDate = Carbon::parse($request->input('start'));
        $endDate = Carbon::parse($request->input('end'));

        $room = Room::query()->findOrFail($id);

        $room->loadMissing([
            'activeBookingRooms' => function ($query) use ($startDate, $endDate) {
                return $query
                    ->whereNot('ht_bookings.status', BookingStatusEnum::CANCELLED)
                    ->where(function ($query) use ($endDate, $startDate) {
                        return $query->where(function ($query) use ($startDate, $endDate) {
                            return $query
                                ->whereDate('start_date', '>=', $startDate)
                                ->whereDate('start_date', '<=', $endDate);
                        })
                            ->orWhere(function ($query) use ($startDate, $endDate) {
                                return $query
                                    ->whereDate('end_date', '>=', $startDate)
                                    ->whereDate('end_date', '<=', $endDate);
                            })
                            ->orWhere(function ($query) use ($startDate, $endDate) {
                                return $query
                                    ->whereDate('start_date', '<=', $startDate)
                                    ->whereDate('end_date', '>=', $endDate);
                            })
                            ->orWhere(function ($query) use ($startDate, $endDate) {
                                return $query
                                    ->whereDate('start_date', '>=', $startDate)
                                    ->whereDate('end_date', '<=', $endDate);
                            });
                    });
            },
        ]);

        $allDates = [];

        for ($i = strtotime($request->query('start')); $i <= strtotime($request->query('end')); $i += 60 * 60 * 24) {
            $date = [
                'id' => rand(0, 999),
                'value' => $room->price,
                'number_of_rooms' => $room->number_of_rooms,
                'is_default' => true,
                'textColor' => '#2791fe',
            ];

            $dateKey = date('Y-m-d', $i);

            $date['price_html'] = format_price($date['value']);
            $date['title'] = $date['event'] = $date['price_html'];
            $date['start'] = $date['end'] = $dateKey;
            $date['value_type'] = 'fixed';

            $date['active'] = 1;
            $allDates[$dateKey] = $date;
        }

        $rows = RoomDate::query()
            ->where('room_id', $id)
            ->whereDate('start_date', '>=', date('Y-m-d', strtotime($request->query('start'))))
            ->whereDate('end_date', '<=', date('Y-m-d', strtotime($request->query('end'))))
            ->take(42)
            ->get();

        if (! empty($rows)) {
            foreach ($rows as $row) {
                $row->start = date('Y-m-d', strtotime($row->start_date));
                $row->end = date('Y-m-d', strtotime($row->start_date));
                $row->textColor = '#2791fe';
                $value = $row->value;
                if (empty($value)) {
                    $value = $room->price;
                }

                if ($row->value_type === 'fixed') {
                    $displayTitle = $value;
                } elseif ($row->value_type === 'amount_adjust') {
                    $displayTitle = $room->price + $value;
                } else {
                    $displayTitle = $room->price + $room->price * $value / 100;
                }
                $row->title = $row->event = format_price($displayTitle);

                if (! $row->active) {
                    $row->title = $row->event = trans('plugins/hotel::room.blocked');
                    $row->backgroundColor = '#fe2727';
                    $row->classNames = ['blocked-event'];
                    $row->textColor = '#fe2727';
                    $row->active = 0;
                } else {
                    $row->classNames = ['active-event'];
                    $row->active = 1;
                }

                $allDates[date('Y-m-d', strtotime($row->start_date))] = $row->toArray();
            }
        }

        $bookings = $room->activeBookingRooms;

        if (! empty($bookings)) {
            foreach ($bookings as $booking) {
                for ($i = strtotime($booking->start_date); $i < strtotime($booking->end_date); $i += 60 * 60 * 24) {
                    $dateKey = date('Y-m-d', $i);
                    if (isset($allDates[$dateKey])) {
                        $allDates[$dateKey]['number_of_rooms'] -= $booking->number_of_rooms;
                        if ($allDates[$dateKey]['number_of_rooms'] <= 0) {
                            $allDates[$dateKey]['active'] = 0;
                            $allDates[$dateKey]['event'] = trans('plugins/hotel::room.full_book');
                            $allDates[$dateKey]['title'] = trans('plugins/hotel::room.full_book');
                            $allDates[$dateKey]['classNames'] = ['full-book-event'];
                            $allDates[$dateKey]['backgroundColor'] = '#ffc107';
                            $allDates[$dateKey]['textColor'] = '#000';
                        }
                    }
                }
            }
        }

        $data = array_values($allDates);

        return response()->json($data);
    }

    public function storeRoomAvailability(int|string $id, Request $request, BaseHttpResponse $response)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        for (
            $i = strtotime($request->input('start_date')); $i <= strtotime(
                $request->input('end_date')
            ); $i += 60 * 60 * 24
        ) {
            if ($request->boolean('active')) {
                RoomDate::query()
                    ->where('room_id', $id)
                    ->whereDate('start_date', date('Y-m-d', $i))
                    ->where('active', 0)
                    ->update(['active' => 1]);
            }

            $roomDate = RoomDate::query()
                ->where('room_id', $id)
                ->whereDate('start_date', date('Y-m-d', $i))
                ->first();

            if (empty($roomDate)) {
                $roomDate = new RoomDate();
                $roomDate->room_id = $id;
            }

            $roomDate->fill($request->input());

            $roomDate->start_date = date('Y-m-d', $i);
            $roomDate->end_date = date('Y-m-d', $i);

            $roomDate->save();
        }

        return $response
            ->withUpdatedSuccessMessage();
    }

    public function postUpdateOrderBy(RoomUpdateOrderByRequest $request, BaseHttpResponse $response)
    {
        $room = Room::query()->findOrFail($request->input('pk'));
        $room->order = $request->input('value', 0);
        $room->save();

        return $response->withUpdatedSuccessMessage();
    }
}
