<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\InClassSubjectService;
use Illuminate\Http\Request;

class InClassSubjectController extends Controller
{
    protected $subjectService;

    public function __construct(InClassSubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function show($weeklyPlanId)
    {
        $subjects = $this->subjectService->getSubjectsByWeeklyPlanId($weeklyPlanId);
        return response()->json($subjects);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'in_class_plan_id' => 'required|integer',
            'date' => 'nullable|date',
            'subject_id' => 'nullable|integer',
            'my_lesson' => 'nullable|string',
            'self_assessment' => 'nullable|integer',
            'my_difficulties' => 'nullable|string',
            'my_plan' => 'nullable|string',
            'problem_solved' => 'nullable|in:Yes,Not yet',
        ]);

        $subject = $this->subjectService->createSubject($data);
        return response()->json($subject, 201);
    }

    // public function show($id)
    // {
    //     $subject = $this->subjectService->getSubject($id);
    //     return $subject ? response()->json($subject) : response()->json(['message' => 'Not Found'], 404);
    // }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'date' => 'nullable|date',
            'subject_id' => 'nullable|integer',
            'my_lesson' => 'nullable|string',
            'self_assessment' => 'nullable|integer',
            'my_difficulties' => 'nullable|string',
            'my_plan' => 'nullable|string',
            'problem_solved' => 'nullable|in:Yes,Not yet',
        ]);

        $updated = $this->subjectService->updateSubject($id, $data);
        return $updated ? response()->json(['message' => 'Updated']) : response()->json(['message' => 'Not Found'], 404);
    }

    public function destroy($id)
    {
        $deleted = $this->subjectService->deleteSubject($id);
        return $deleted ? response()->json(['message' => 'Deleted']) : response()->json(['message' => 'Not Found'], 404);
    }
}
