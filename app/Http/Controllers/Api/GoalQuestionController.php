<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\GoalQuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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

    public function getGoalQuestionsByStudent()
    {
        $userId = Auth::id();
        $goalQuestions = $this->goalQuestionRepository->getByStudent($userId);
        return response()->json($goalQuestions);
    }

    // Lấy câu hỏi theo id
    public function show($id)
    {
        $goalQuestion = $this->goalQuestionRepository->find($id);
        if (!$goalQuestion) {
            return response()->json(['message' => 'Câu hỏi không tồn tại'], 404);
        }
        return response()->json($goalQuestion);
    }

    // Tạo câu hỏi mới (student gửi)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'semester_id' => 'required|exists:semesters,id',
            'subject_id' => 'required|exists:subjects,id',
            'question' => 'required|string',
            'teacher_id' => 'nullable|exists:users,id', // Thêm validate cho teacher_id
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->only(['user_id', 'semester_id', 'subject_id', 'question', 'teacher_id']);

        $goalQuestion = $this->goalQuestionRepository->create($data);

        return response()->json($goalQuestion, 201);
    }

    // Cập nhật câu hỏi hoặc trả lời
    public function update(Request $request, $id)
    {
        $goalQuestion = $this->goalQuestionRepository->find($id);

        if (!$goalQuestion) {
            return response()->json(['message' => 'Câu hỏi không tồn tại'], 404);
        }

        $data = $request->only(['question', 'answer', 'answered_by', 'answered_at', 'teacher_id']);

        if (isset($data['answer']) && !isset($data['answered_at'])) {
            $data['answered_at'] = now();
        }

        $updatedGoalQuestion = $this->goalQuestionRepository->update($id, $data);

        return response()->json($updatedGoalQuestion);
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

    // Lấy câu hỏi chưa trả lời của học sinh (dựa trên userId, semesterId, subjectId)
    public function getUnansweredByStudent(Request $request, $userId, $semesterId, $subjectId)
    {
        $questions = $this->goalQuestionRepository->getUnansweredByStudent($userId, $semesterId, $subjectId);

        return response()->json([
            'unread' => $questions->count(),
            'questions' => $questions,
        ]);
    }

    // Lấy câu hỏi chưa trả lời cho giáo viên hiện tại, filter optional theo semester_id, subject_id
    public function getUnreadQuestions(Request $request)
    {
        $teacherId = $request->user()->id;

        $semesterId = $request->query('semester_id');
        $subjectId = $request->query('subject_id');

        $questions = $this->goalQuestionRepository->getUnreadQuestionsForTeacher($teacherId, $semesterId, $subjectId);

        return response()->json([
            'unread' => $questions->count(),
            'questions' => $questions,
        ]);
    }

    // Giáo viên trả lời nhiều câu hỏi
    public function answer(Request $request)
    {
        $teacherId = Auth::id();

        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'answers.*.id' => 'required|exists:goal_questions,id',
            'answers.*.answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updatedQuestions = [];

        foreach ($request->input('answers') as $item) {
            $questionId = $item['id'];
            $answerText = $item['answer'];

            $question = $this->goalQuestionRepository->find($questionId);

            if ($question && !$question->answer) {
                $updateData = [
                    'answer' => $answerText,
                    'answered_by' => $teacherId,
                    'answered_at' => now(),
                ];

                $updated = $this->goalQuestionRepository->update($questionId, $updateData);
                $updatedQuestions[] = $updated;
            }
        }

        return response()->json([
            'message' => 'Answers submitted successfully',
            'updated' => $updatedQuestions,
        ]);
    }
}
