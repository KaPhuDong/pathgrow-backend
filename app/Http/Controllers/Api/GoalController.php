<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GoalServiceInterface;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    protected $goalService;

    public function __construct(GoalServiceInterface $goalService)
    {
        $this->goalService = $goalService;
    }

    public function index()
    {
        return response()->json($this->goalService->getAllGoals());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|in:not_started,in_progress,completed',
        ]);

        return response()->json($this->goalService->createGoal($validated), 201);
    }

    public function show($id)
    {
        return response()->json($this->goalService->getGoalById($id));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|in:not_started,in_progress,completed',
        ]);

        return response()->json($this->goalService->updateGoal($id, $validated));
    }

    public function destroy($id)
    {
        $this->goalService->deleteGoal($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
