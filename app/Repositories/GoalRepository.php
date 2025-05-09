<?php
namespace App\Repositories;

use App\Models\Goal;

class GoalRepository implements GoalRepositoryInterface
{
    protected $model;

    public function __construct(Goal $goal)
    {
        $this->model = $goal;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $goal = $this->find($id);
        $goal->update($data);
        return $goal;
    }

    public function delete($id)
    {
        $goal = $this->find($id);
        return $goal->delete();
    }
}
