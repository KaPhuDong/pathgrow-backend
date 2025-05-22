<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WeeklyGoalService;
use Illuminate\Http\Request;

class WeeklyGoalController extends Controller
{
    protected $service;

    public function __construct(WeeklyGoalService $service)
    {
        $this->service = $service;
    }

    public function index($weeklyStudyPlanId)
    {
        return response()->json($this->service->getGoals($weeklyStudyPlanId));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'weekly_study_plan_id' => 'required|exists:weekly_study_plans,id',
            'completed' => 'required|boolean',
        ]);

        return response()->json($this->service->createGoal($validated), 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'weekly_study_plan_id' => 'sometimes|required|exists:weekly_study_plans,id',
            'completed' => 'sometimes|required|boolean',
        ]);

        return response()->json($this->service->updateGoal($id, $validated));
    }

    public function destroy($id)
    {
        $this->service->deleteGoal($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
