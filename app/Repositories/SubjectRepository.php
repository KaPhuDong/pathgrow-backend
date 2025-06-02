<?php

namespace App\Repositories;

use App\Models\Subject;

class SubjectRepository
{
    public function getAll()
    {
        return Subject::all();
    }
}
