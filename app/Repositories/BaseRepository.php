<?php

namespace App\Repositories;

class BaseRepository
{
    protected $model;
    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($model, $data)
    {
        $model->update($data);
        return $model;
    }

    public function delete($model)
    {
        $model->delete();
        return true;
    }

    
}