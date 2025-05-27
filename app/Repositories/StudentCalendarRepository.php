<?php

namespace App\Repositories;

use App\Models\StudentCalendar;
use Illuminate\Support\Facades\Auth;

class StudentCalendarRepository
{
    public function getByUserId($userId)
    {
        return StudentCalendar::where('user_id', $userId)->get();
    }

    public function getByUser()
    {
        return StudentCalendar::where('user_id', Auth::id())->get();
    }

    public function addCalendarByUserId(array $data)
    {
        $data['user_id'] = $data['user_id'];
        return StudentCalendar::create($data);
    }

    public function create(array $data)
    {
        $data['user_id'] = Auth::id();
        return StudentCalendar::create($data);
    }

    public function deleteCalendarByUserId($userId, $id)
    {
        $calendar = StudentCalendar::where('id', $id)
                                ->where('user_id', $userId)
                                ->firstOrFail();
        return $calendar->delete();
    }

    public function delete($id)
    {
        $calendar = StudentCalendar::where('user_id', Auth::id())->findOrFail($id);
        return $calendar->delete();
    }
}
