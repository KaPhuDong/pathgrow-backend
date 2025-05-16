<?php

namespace App\Repositories;

use App\Models\Classes;

class ClassRepository
{
    protected $model;

    public function __construct(Classes $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $class = $this->model->findOrFail($id);
        $class->update($data);
        return $class;
    }

    public function delete($id)
    {
        $class = $this->model->findOrFail($id);
        return $class->delete();
    }
}
