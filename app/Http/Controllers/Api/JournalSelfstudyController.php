<?php
// app/Http/Controllers/Api/JournalSelfstudyController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\JournalSelfstudyRepository;

class JournalSelfstudyController extends Controller
{
    protected $repository;

    public function __construct(JournalSelfstudyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return response()->json($this->repository->getAll());
    }

    public function show($id)
    {
        return response()->json($this->repository->getById($id));
    }

    public function listByJournal($journalId)
    {
        return response()->json($this->repository->getList($journalId));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'journal_id' => 'required|integer',
        'date' => 'required|date',
        'skills_module' => 'nullable|string',
        'lesson_summary' => 'nullable|string',
        'time_allocation' => 'nullable|string',
        'learning_resources' => 'nullable|string',
        'learning_activities' => 'nullable|string',
        'concentration' => 'nullable|integer',
        'plan_follow_reflection' => 'nullable|string',
        'work_evaluation' => 'nullable|string',
        'reinforce_techniques' => 'nullable|string',
        'notes' => 'nullable|string',
    ]);

    $created = $this->repository->create($validated);
    return response()->json($created, 201); 
}


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
        'journal_id' => 'required|integer',
        'date' => 'required|date',
        'skills_module' => 'nullable|string',
        'lesson_summary' => 'nullable|string',
        'time_allocation' => 'nullable|string',
        'learning_resources' => 'nullable|string',
        'learning_activities' => 'nullable|string',
        'concentration' => 'nullable|integer',
        'plan_follow_reflection' => 'nullable|string',
        'work_evaluation' => 'nullable|string',
        'reinforce_techniques' => 'nullable|string',
        'notes' => 'nullable|string',
    ]);

        $updated = $this->repository->update($id, $validated);
        return response()->json($updated);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
