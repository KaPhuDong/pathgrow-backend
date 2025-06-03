<?php

namespace App\Services;

use App\Repositories\InClassSubjectRepository;

class InClassSubjectService
{
    protected $subjectRepository;

    public function __construct(InClassSubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function getSubjectsByWeeklyPlanId($weeklyPlanId)
    {
        return $this->subjectRepository->getByWeeklyStudyPlanId($weeklyPlanId);
    }

    public function createSubject(array $data)
    {
        return $this->subjectRepository->create($data);
    }

    public function getSubject(int $id)
    {
        return $this->subjectRepository->find($id);
    }

    public function updateSubject(int $id, array $data)
    {
        return $this->subjectRepository->update($id, $data);
    }

    public function deleteSubject(int $id)
    {
        return $this->subjectRepository->delete($id);
    }
}
