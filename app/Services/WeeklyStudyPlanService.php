<?php

namespace App\Services;

use App\Repositories\WeeklyStudyPlanRepository;

class WeeklyStudyPlanService
{
    protected $repo;

    public function __construct(WeeklyStudyPlanRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getByStudentId($studentId)
    {
        return $this->repo->getByStudentId($studentId);
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
