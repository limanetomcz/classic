<?php

namespace App\Contracts;

interface PlaceRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create($data);
    public function update($place, $data);
    public function delete($place);
    
}