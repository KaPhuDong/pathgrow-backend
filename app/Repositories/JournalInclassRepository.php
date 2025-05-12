<?php
namespace App\Repositories;

use App\Models\JournalInclassDetail;

class JournalInclassRepository
{
    // Lấy tất cả các bản ghi
    public function getAll()
    {
        return JournalInclassDetail::all();
    }

    // Lấy bản ghi theo ID
    public function getById($id)
    {
        return JournalInclassDetail::findOrFail($id);
    }

    // Lấy danh sách theo journal_id
    public function getByJournalId($journalId)
    {
        return JournalInclassDetail::where('journal_id', $journalId)->get();
    }

    // Tạo mới bản ghi
    public function create(array $data)
    {
        return JournalInclassDetail::create($data);
    }

    // Cập nhật bản ghi
    public function update($id, array $data)
    {
        $journalInclass = JournalInclassDetail::findOrFail($id);
        $journalInclass->update($data);
        return $journalInclass;
    }

    // Xóa bản ghi
    public function delete($id)
    {
        $journalInclass = JournalInclassDetail::findOrFail($id);
        $journalInclass->delete();
        return $journalInclass;
    }
}
