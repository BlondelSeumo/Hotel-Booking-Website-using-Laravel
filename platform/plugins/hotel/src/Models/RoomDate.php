<?php

namespace Botble\Hotel\Models;

use Botble\Base\Models\BaseModel;

class RoomDate extends BaseModel
{
    protected $table = 'ht_room_dates';

    protected $fillable = [
        'room_id',
        'start_date',
        'end_date',
        'value',
        'value_type',
        'max_guests',
        'active',
        'note_to_customer',
        'note_to_admin',
        'number_of_rooms',
    ];
}
