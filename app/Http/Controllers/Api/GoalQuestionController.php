<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\GoalQuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoalQuestionController extends Controller
{
    protected $goalQuestionRepository;

    public function __construct(GoalQuestionRepository $goalQuestionRepository)
    {
        $this->goalQuestionRepository = $goalQuestionRepository;
    }

    // Lấy tất cả câu hỏi
    public function index()
    {
        $goalQuestions = $this->goalQuestionRepository->all();
        return response()->json($goalQuestions);
    }

    // Lấy câu hỏi theo ID
    public function show($id)
    {
        $goalQuestion = $this->goalQuestionRepository->find($id);

        if (!$goalQuestion) {
            return response()->json(['message' => 'Câu hỏi không tồn tại'], 404);
        }

        return response()->json($goalQuestion);
    }

    // Tạo mới câu hỏi
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'semester_id' => 'required|exists:semesters,id',
            'subject_id' => 'required|exists:subjects,id',
            'question' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $goalQuestion = $this->goalQuestionRepository->create($request->all());

        return response()->json($goalQuestion, 201);
    }

    // Cập nhật câu hỏi
    public function update(Request $request, $id)
    {
        $goalQuestion = $this->goalQuestionRepository->find($id);

        if (!$goalQuestion) {
            return response()->json(['message' => 'Câu hỏi không tồn tại'], 404);
        }

        $goalQuestion = $this->goalQuestionRepository->update($id, $request->all());

        return response()->json($goalQuestion);
    }

    // Xóa câu hỏi
    public function destroy($id)
    {
        $deleted = $this->goalQuestionRepository->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Câu hỏi không tồn tại'], 404);
        }

        return response()->json(['message' => 'Câu hỏi đã bị xóa thành công']);
    }
}
