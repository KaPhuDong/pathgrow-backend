<?php
namespace App\Repositories;

use App\Models\JournalInclassDetail;

class JournalInclassRepository
{
    public function getAll()
    {
        return JournalInclassDetail::all();
    }

    public function getById($id)
    {
        return JournalInclassDetail::findOrFail($id);
    }

    public function getByJournalId($journalId)
    {
        return JournalInclassDetail::where('journal_id', $journalId)->get();
    }

    public function create(array $data)
    {
        return JournalInclassDetail::create($data);
    }

    public function update($id, array $data)
    {
        $item = JournalInclassDetail::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        $item = JournalInclassDetail::findOrFail($id);
        $item->delete();
        return $item;
    }
}
