<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::all();

        return response()->json([
            'message' => 'List of semesters',
            'data' => $semesters
        ], 200);
    }
}
