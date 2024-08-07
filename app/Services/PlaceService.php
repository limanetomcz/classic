<?php

namespace App\Services;

use App\Repositories\PlaceRepository;

class PlaceService
{
    protected PlaceRepository $repository;

    public function __construct(PlaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPlaces()
    {
        return $this->repository->getAll();
    }

    public function searchPlaces($query)
    {
        return $this->repository->search($query);
    }

    public function getPlaceById($id)
    {
        return $this->repository->getById($id);
    }

    public function createPlace($data)
    {
        return $this->repository->create($data);
    }

    public function updatePlace($place, $data)
    {
        return $this->repository->update($place, $data);
    }

    public function deletePlace($place)
    {
        return $this->repository->delete($place);
    }
}