<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\StudentCalendarRepository;
use Illuminate\Http\Request;

class StudentCalendarController extends Controller
{
    protected $calendarRepo;

    public function __construct(StudentCalendarRepository $calendarRepo)
    {
        $this->calendarRepo = $calendarRepo;
    }

    public function getCalendarByUserId($userId)
    {
        return response()->json($this->calendarRepo->getByUserId($userId));
    }

    public function addCalendarByUserId(Request $request, $userId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'day_of_week' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'color' => 'nullable|string',
        ]);

        $validated['user_id'] = $userId;

        $calendar = $this->calendarRepo->addCalendarByUserId($validated);
        return response()->json($calendar, 201);
    }

    public function deleteCalendarByUserId($userId, $id)
    {
        $this->calendarRepo->deleteCalendarByUserId($userId, $id);
        return response()->json(['message' => 'Event deleted successfully']);
    }

    public function index()
    {
        return response()->json($this->calendarRepo->getByUser());
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'day_of_week' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'color' => 'nullable|string',
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
