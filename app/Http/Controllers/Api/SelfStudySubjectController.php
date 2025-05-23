<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SelfStudySubjectService;
use Illuminate\Http\Request;

class SelfStudySubjectController extends Controller
{
    protected $subjectService;

    public function __construct(SelfStudySubjectService $subjectService)
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
            'self_study_plan_id' => 'required|integer',
            'date' => 'nullable|date',
            'subject_id' => 'nullable|integer|exists:subjects,id',
            'my_lesson' => 'nullable|string',
            'time_allocation' => 'nullable|string',
            'learning_resources' => 'nullable|string',
            'learning_activities' => 'nullable|string',
            'concentration' => 'nullable|in:Yes,No,Not sure',
            'plan_follow_reflection' => 'nullable|in:Yes,No,Not sure',
            'evaluation' => 'nullable|string',
            'reinforcing_learning' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $subject = $this->subjectService->createSubject($data);
        return response()->json($subject, 201);
    }

     public function update(Request $request, $id)
    {
        $data = $request->validate([
            'date' => 'nullable|date',
            'subject_id' => 'nullable|integer|exists:subjects,id',
            'my_lesson' => 'nullable|string',
            'time_allocation' => 'nullable|string',
            'learning_resources' => 'nullable|string',
            'learning_activities' => 'nullable|string',
            'concentration' => 'nullable|in:Yes,No,Not sure',
            'plan_follow_reflection' => 'nullable|in:Yes,No,Not sure',
            'evaluation' => 'nullable|string',
            'reinforcing_learning' => 'nullable|string',
            'notes' => 'nullable|string',
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
