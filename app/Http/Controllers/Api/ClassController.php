<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ClassRepository;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    protected $classRepo;

    public function __construct(ClassRepository $classRepo)
    {
        $this->classRepo = $classRepo;
    }

    public function index()
    {
        $classes = $this->classRepo->all();
        return response()->json($classes);
    }

    public function show($id)
    {
        $class = $this->classRepo->find($id);
        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }
        return response()->json($class);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50|unique:classes,name',
            'students' => 'nullable|integer',
            'color' => 'required|string|max:7',
            'slug' => 'required|string|max:20|unique:classes,slug',
        ]);

        $class = $this->classRepo->create($data);
        return response()->json($class, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:50|unique:classes,name,' . $id,
            'students' => 'nullable|integer',
            'color' => 'sometimes|string|max:7',
            'slug' => 'sometimes|string|max:20|unique:classes,slug,' . $id,
        ]);

        $class = $this->classRepo->update($id, $data);
        return response()->json($class);
    }

    public function destroy($id)
    {
        $this->classRepo->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
