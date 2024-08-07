<?php

namespace App\Repositories;

use App\Contracts\PlaceRepositoryInterface;
use App\Models\Place;

class PlaceRepository extends BaseRepository implements PlaceRepositoryInterface
{
    public function __construct(Place $model)
    {
        $this->model = $model;
    }

    public function search($query)
    {
        return $this->model->where('name', 'LIKE', "%{$query}%")
            ->orWhere('city', 'LIKE', "%{$query}%")
            ->orWhere('state', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->get();
    }
}
