<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\StudentCalendarRepository;
use Illuminate\Http\Request;

class TeacherScheduleController extends Controller
{
    protected $calendarRepo;

    public function __construct(StudentCalendarRepository $calendarRepo)
    {
        $this->calendarRepo = $calendarRepo;
    }

    public function index()
    {
        return response()->json($this->calendarRepo->getByUser());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'day_of_week' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'remind_at' => 'nullable|date|before_or_equal:start_time',
            'notified' => 'boolean',
        ]);

        $calendar = $this->calendarRepo->create($validated);
        return response()->json($calendar, 201);
    }

    public function destroy($id)
    {
        $this->calendarRepo->delete($id);
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
