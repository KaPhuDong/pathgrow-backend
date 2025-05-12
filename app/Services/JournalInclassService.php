<?php
namespace App\Services;

use App\Repositories\JournalInclassRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JournalInclassService
{
    protected $journalInclassRepository;

    public function __construct(JournalInclassRepository $journalInclassRepository)
    {
        $this->journalInclassRepository = $journalInclassRepository;
    }

    // Lấy tất cả các bản ghi
    public function getAll()
    {
        return $this->journalInclassRepository->getAll();
    }

    // Lấy bản ghi theo ID
    public function getById($id)
    {
        return $this->journalInclassRepository->getById($id);
    }

    // Lấy danh sách theo journal_id
    public function getList($journalId)
    {
        return $this->journalInclassRepository->getByJournalId($journalId); // Gọi phương thức repository
    }

    // Tạo mới
    public function create(array $data)
    {
        $this->validate($data);
        return $this->journalInclassRepository->create($data);
    }

    // Cập nhật
    public function update($id, array $data)
    {
        $this->validate($data);
        return $this->journalInclassRepository->update($id, $data);
    }

    // Xóa
    public function delete($id)
    {
        return $this->journalInclassRepository->delete($id);
    }

    // Validate dữ liệu
    protected function validate(array $data)
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
