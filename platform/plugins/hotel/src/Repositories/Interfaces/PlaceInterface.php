<?php

namespace Botble\Hotel\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface PlaceInterface extends RepositoryInterface
{
    public function getRelatedPlaces(int $placeId, $limit = 3);
}
