<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class ListStudentController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * ✅ MỚI: Lấy danh sách sinh viên thuộc class_id
     */
    public function listByClass($classId)
    {
        $students = $this->userRepo->getStudentsByClass((int) $classId);

        return response()->json([
            'success' => true,
            'data' => $students
        ]);
    }
}
