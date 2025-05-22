<?php

namespace App\Repositories;

use App\Models\StudentCalendar;
use Illuminate\Support\Facades\Auth;

class StudentCalendarRepository
{
    public function getByUser()
    {
        return StudentCalendar::where('user_id', Auth::id())->get();
    }

    public function create(array $data)
    {
        $data['user_id'] = Auth::id();
        return StudentCalendar::create($data);
    }

    public function delete($id)
    {
        $calendar = StudentCalendar::where('user_id', Auth::id())->findOrFail($id);
        return $calendar->delete();
    }
}
