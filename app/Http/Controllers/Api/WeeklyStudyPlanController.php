<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WeeklyStudyPlanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeeklyStudyPlanController extends Controller
{
    protected $service;

    public function __construct(WeeklyStudyPlanService $service)
    {
        $this->service = $service;
    }

    public function getPlansByUserId($userId)
    {
        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $weeks = $this->service->getByStudentId($userId);
        return response()->json($weeks);
    }

    public function index()
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $weeks = $this->service->getByStudentId($userId);
        return response()->json($weeks);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $data['student_id'] = $userId;

        return response()->json($this->service->create($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->service->find($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after_or_equal:start_date',
        ]);

        return response()->json($this->service->update($id, $data));
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
