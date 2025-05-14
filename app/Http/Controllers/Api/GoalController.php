<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\GoalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;



class GoalController extends Controller
{
    protected $goalRepository;

    public function __construct(GoalRepository $goalRepository)
    {
        $this->goalRepository = $goalRepository;
    }

    public function index()
    {
        $goals = $this->goalRepository->all();
        return response()->json($goals);
    }

    public function show($id)
    {
        $goal = $this->goalRepository->find($id);

        if (!$goal) {
            return response()->json(['message' => 'Mục tiêu không tồn tại'], 404);
        }

        return response()->json($goal);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'semester' => 'required|exists:semesters,id',
            'subject' => 'required|string', // e.g., "it", "toeic"
            'expect_course' => 'nullable|string',
            'expect_teacher' => 'nullable|string',
            'expect_myself' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $subject = Subject::where('key', $request->subject)->first();
        if (!$subject) return response()->json(['message' => 'Subject không hợp lệ'], 404);

        $data = $request->only(['expect_course', 'expect_teacher', 'expect_myself']);
        $data['user_id'] = $request->user_id;
        $data['semester_id'] = $request->semester;
        $data['subject_id'] = $subject->id;

        $goal = $this->goalRepository->create($data);
        return response()->json($goal, 201);
    }

    public function update(Request $request, $id)
    {
        $goal = $this->goalRepository->find($id);

        if (!$goal) {
            return response()->json(['message' => 'Mục tiêu không tồn tại'], 404);
        }

        $data = $request->only(['expect_course', 'expect_teacher', 'expect_myself']);
        $goal = $this->goalRepository->update($id, $data);
        return response()->json($goal);
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
