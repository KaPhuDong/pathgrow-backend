<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SubjectService;

class SubjectController extends Controller
{
    protected $subjectService;

    public function __construct()
    {
        $this->subjectService = new SubjectService();
    }

    public function getAllSubjects()
    {
        return $this->subjectService->getAllSubjects();
    }
}
