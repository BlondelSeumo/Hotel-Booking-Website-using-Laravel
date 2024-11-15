<?php

namespace Botble\Hotel\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface RoomInterface extends RepositoryInterface
{
    public function getRooms(array $filters = [], array $params = []);

    public function getRelatedRooms(int $roomId, int $limit = 4, array $params = []);
}
