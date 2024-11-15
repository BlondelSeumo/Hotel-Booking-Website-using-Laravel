<?php

namespace Botble\Hotel\Repositories\Eloquent;

use Botble\Hotel\Enums\BookingStatusEnum;
use Botble\Hotel\Repositories\Interfaces\BookingInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;

class BookingRepository extends RepositoriesAbstract implements BookingInterface
{
    public function getPendingBookings(array $select = ['*'], array $with = [])
    {
        $data = $this->model->where('status', BookingStatusEnum::PENDING)
            ->select($select)
            ->with($with)
            ->get();

        $this->resetModel();

        return $data;
    }

    public function countPendingBookings(): int
    {
        $data = $this->model->where('status', BookingStatusEnum::PENDING)->count();

        $this->resetModel();

        return $data;
    }
}
