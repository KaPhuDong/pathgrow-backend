<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\InClassPlanService;
use Illuminate\Http\Request;

class InClassPlanController extends Controller
{
    protected $planService;

    public function __construct(InClassPlanService $planService)
    {
        $this->planService = $planService;
    }

    public function show($weeklyStudyPlanId)
    {
        $plan = $this->planService->getPlanByWeeklyStudyPlanId($weeklyStudyPlanId);
        return response()->json($plan);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'weekly_study_plan_id' => 'required|integer|exists:weekly_study_plans,id',
        ]);

        $plan = $this->planService->createPlan($data);
        return response()->json($plan, 201);
    }

    // public function show($id)
    // {
    //     $plan = $this->planService->getPlan($id);
    //     return $plan ? response()->json($plan) : response()->json(['message' => 'Not Found'], 404);
    // }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'weekly_study_plan_id' => 'required|integer|exists:weekly_study_plans,id',
        ]);

        $updated = $this->planService->updatePlan($id, $data);
        return $updated ? response()->json(['message' => 'Updated']) : response()->json(['message' => 'Not Found'], 404);
    }

    public function destroy($id)
    {
        $deleted = $this->planService->deletePlan($id);
        return $deleted ? response()->json(['message' => 'Deleted']) : response()->json(['message' => 'Not Found'], 404);
    }
}
