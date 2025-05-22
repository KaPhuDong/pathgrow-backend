<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ClassManagementRepository;
use Illuminate\Support\Str;

class ClassManagementController extends Controller
{
    protected $classRepository;

    public function __construct(ClassManagementRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }

    /**
     * Lấy danh sách lớp học
     */
    public function index()
    {
        $classes = $this->classRepository->getAll();
        return response()->json($classes);
    }

    /**
     * Thêm lớp học mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:classes,name',
            'color' => 'required|string|size:7',
            'students' => 'nullable|integer|min:0',
        ]);

        $data = [
            'name' => $request->name,
            'color' => $request->color,
            'students' => $request->input('students', 0), // nếu không có thì dùng 0
            'slug' => Str::slug($request->name),
        ];

        $class = $this->classRepository->create($data);
        return response()->json($class, 201);
    }

    /**
     * Hiển thị theo lớp
     */
    public function show($id)
    {
        $class = $this->classRepository->find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        return response()->json($class);
    }


    /**
     * Sửa tên lớp học
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:classes,name,' . $id,
            'color' => 'nullable|string|size:7',
            'students' => 'nullable|integer|min:0',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        // Thêm các field nếu người dùng gửi lên
        if ($request->has('color')) {
            $data['color'] = $request->color;
        }

        if ($request->has('students')) {
            $data['students'] = $request->students;
        }

        $updated = $this->classRepository->update($id, $data);

        if (!$updated) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        return response()->json(['message' => 'Class updated successfully']);
    }


    /**
     * Xóa lớp học
     */
    public function destroy($id)
    {
        $deleted = $this->classRepository->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        return response()->json(['message' => 'Class deleted successfully']);
    }
}
