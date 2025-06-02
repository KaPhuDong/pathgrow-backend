<?php

namespace App\Services;

use App\Repositories\SubjectRepository;

class SubjectService
{
    protected $subjectRepo;

    public function __construct()
    {
        $this->subjectRepo = new SubjectRepository();
    }

    public function getAllSubjects()
    {
        return $this->subjectRepo->getAll();
    }
}
