<?php

namespace Botble\Hotel\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface BookingInterface extends RepositoryInterface
{
    public function getPendingBookings(array $select = ['*'], array $with = []);

    public function countPendingBookings(): int;
}
