<?php

namespace App\Repositories;

use App\Models\ClassesManagement;

class ClassManagementRepository
{
    public function getAll()
    {
        return ClassesManagement::all();
    }

    public function find($id)
    {
        return ClassesManagement::find($id);
    }


    public function create(array $data)
    {
        return ClassesManagement::create($data);
    }

    public function update($id, array $data)
    {
        $class = ClassesManagement::find($id);
        if (!$class) {
            return false;
        }

        $class->update($data);
        return true;
    }

    public function delete($id)
    {
        $class = ClassesManagement::find($id);
        if (!$class) {
            return false;
        }

        $class->delete();
        return true;
    }
}
