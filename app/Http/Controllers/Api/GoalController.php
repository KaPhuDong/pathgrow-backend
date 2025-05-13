<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\GoalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoalController extends Controller
{
    protected $goalRepository;

    public function __construct(GoalRepository $goalRepository)
    {
        $this->goalRepository = $goalRepository;
    }

    // Lấy tất cả mục tiêu
    public function index()
    {
        $goals = $this->goalRepository->all();
        return response()->json($goals);
    }

    // Lấy mục tiêu theo ID
    public function show($id)
    {
        $goal = $this->goalRepository->find($id);

        if (!$goal) {
            return response()->json(['message' => 'Mục tiêu không tồn tại'], 404);
        }

        return response()->json($goal);
    }

    // Tạo mới mục tiêu
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'semester_id' => 'required|exists:semesters,id',
            'subject_id' => 'required|exists:subjects,id',
            'expect_course' => 'nullable|string',
            'expect_teacher' => 'nullable|string',
            'expect_myself' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $goal = $this->goalRepository->create($request->all());

        return response()->json($goal, 201);
    }

    // Cập nhật mục tiêu
    public function update(Request $request, $id)
    {
        $goal = $this->goalRepository->find($id);

        if (!$goal) {
            return response()->json(['message' => 'Mục tiêu không tồn tại'], 404);
        }

        $goal = $this->goalRepository->update($id, $request->all());

        return response()->json($goal);
    }

    // Xóa mục tiêu
    public function destroy($id)
    {
        $deleted = $this->goalRepository->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Mục tiêu không tồn tại'], 404);
        }

        return response()->json(['message' => 'Mục tiêu đã bị xóa thành công']);
    }
}
