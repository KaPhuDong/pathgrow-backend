<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SubjectService;
use App\Models\Subject;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $query = Subject::query();

        if ($request->has('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        return response()->json([
            'message' => 'Danh sách môn học',
            'data' => $query->get()
        ]);
    }
}
