<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\GoalRepository;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    protected $goalRepo;

    public function __construct(GoalRepository $goalRepo)
    {
        $this->goalRepo = $goalRepo;
    }

    public function index()
    {
        return response()->json($this->goalRepo->all());
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

        $goal = $this->goalRepo->create($validated);
        return response()->json($goal, 201);
    }

    public function show($id)
    {
        $goal = $this->goalRepo->find($id);
        return response()->json($goal);
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

        $goal = $this->goalRepo->update($id, $validated);
        return response()->json($goal);
    }

    public function destroy($id)
    {
        $this->goalRepo->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
