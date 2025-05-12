<?php

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
        $created = $this->repository->create($request->all());
        return response()->json($created, 201);
    }

    public function update(Request $request, $id)
    {
        $updated = $this->repository->update($id, $request->all());
        return response()->json($updated);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
