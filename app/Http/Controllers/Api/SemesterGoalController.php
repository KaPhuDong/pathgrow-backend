<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SemesterGoalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use App\Models\SemesterGoal;



class SemesterGoalController extends Controller
{
    protected $goalRepository;

    public function __construct(SemesterGoalRepository $goalRepository)
    {
        $this->goalRepository = $goalRepository;
    }

    public function getGoalsByUserId($userId, $semesterId, $subjectId) 
    {
        $goal = SemesterGoal::where('user_id', $userId)
                    ->where('semester_id', $semesterId)
                    ->where('subject_id', $subjectId)
                    ->first();

        if (!$goal) {
            return response()->json((object)[]);
        }

        return response()->json($goal);
    }

    public function show($semesterId, $subjectId)
    {
        $userId = Auth::id();

        $goal = SemesterGoal::where('user_id', $userId)
                    ->where('semester_id', $semesterId)
                    ->where('subject_id', $subjectId)
                    ->first();

         if (!$goal) {
        return response()->json((object)[]);
    }

    return response()->json($goal);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'semester_id' => 'required|exists:semesters,id',
            'subject_id' => 'required|exists:subjects,id',
            'expect_course' => 'nullable|string',
            'expect_teacher' => 'nullable|string',
            'expect_myself' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->only([
            'semester_id',
            'subject_id',
            'expect_course',
            'expect_teacher',
            'expect_myself',
        ]);

        $userId = Auth::id();
        $data['user_id'] = $userId;

        $goal = $this->goalRepository->create($data);

        return response()->json([
            'message' => 'Goal created successfully',
            'data' => $goal,
        ], 201);
    }

    public function update(Request $request, $semesterId, $subjectId)
    {
        $userId = Auth::id();

        $goal = SemesterGoal::where('user_id', $userId)
                    ->where('semester_id', $semesterId)
                    ->where('subject_id', $subjectId)
                    ->first();

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        $goal->expect_course = $request->input('expect_course');
        $goal->expect_teacher = $request->input('expect_teacher');
        $goal->expect_myself = $request->input('expect_myself');
        
        $goal->save();

        return response()->json(['message' => 'Goal updated successfully', 'goal' => $goal], 200);
    }

    public function destroy($id)
    {
        $deleted = $this->goalRepository->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Mục tiêu không tồn tại'], 404);
        }

        return response()->json(['message' => 'Mục tiêu đã bị xóa thành công']);
    }

    public function getBySemesterAndSubject(Request $request)
    {
        $userId = Auth::id();
        $semesterId = $request->query('semester');
        $subjectKey = $request->query('subject');

        $subject = Subject::where('key', $subjectKey)->first();
        if (!$subject) {
            return response()->json(['message' => 'Subject không tồn tại'], 404);
        }

        $goal = $this->goalRepository->findByUserSemesterSubject($userId, $semesterId, $subject->id);

        return response()->json($goal);
    }
}
