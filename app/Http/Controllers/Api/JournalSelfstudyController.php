<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JournalSelfstudyService;

class JournalSelfstudyController extends Controller
{
    protected $service;

    public function __construct(JournalSelfstudyService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        return response()->json($this->service->getById($id));
    }

    public function listByJournal($journalId)
    {
        return response()->json($this->service->getList($journalId));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $created = $this->service->create($data);
        return response()->json($created, 201);
    }

    public function update(Request $request, $id)
    {
        $updated = $this->service->update($id, $request->all());
        return response()->json($updated);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
