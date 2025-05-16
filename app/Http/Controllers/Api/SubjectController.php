<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Danh sách môn học',
            'data' => Subject::all()
        ]);
    }
}
