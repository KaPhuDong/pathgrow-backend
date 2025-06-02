<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::query();

        if ($request->has('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        return response()->json([
            'message' => 'Danh sách môn học',
            'data' => $query->get()
        ]);
    }
}
