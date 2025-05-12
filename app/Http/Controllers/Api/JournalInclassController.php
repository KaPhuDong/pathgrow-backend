<?php
namespace App\Http\Controllers\Api;

use App\Repositories\JournalInclassRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JournalInclassController extends Controller
{
    protected $repository;

    public function __construct(JournalInclassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $journalId = $request->query('journal_id');
        if ($journalId) {
            return response()->json($this->repository->getByJournalId($journalId));
        }
        return response()->json($this->repository->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->validateData($data);
        return response()->json($this->repository->create($data));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->validateData($data);
        return response()->json($this->repository->update($id, $data));
    }

    public function delete($id)
    {
        return response()->json($this->repository->delete($id));
    }

    protected function validateData(array $data)
    {
        $validator = Validator::make($data, [
            'journal_id'        => 'required|integer|exists:journals,id',
            'date'              => 'required|date',
            'skills_module'     => 'nullable|string|max:255',
            'lesson_summary'    => 'nullable|string',
            'self_assessment'   => 'nullable|integer|min:0|max:10',
            'difficulties'      => 'nullable|string',
            'improvement_plan'  => 'nullable|string',
            'problem_solved'    => 'boolean',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
