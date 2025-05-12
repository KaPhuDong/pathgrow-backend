<?php

namespace App\Repositories;

use App\Models\JournalSelfstudyDetail;

class JournalSelfstudyRepository
{
    public function getAll()
    {
        return JournalSelfstudyDetail::all();
    }

    public function getById($id)
    {
        return JournalSelfstudyDetail::find($id);
    }

    public function getList($journalId)
    {
        return JournalSelfstudyDetail::where('journal_id', $journalId)->get();
    }

    public function create(array $data)
    {
        return JournalSelfstudyDetail::create($data);
    }

    public function update($id, array $data)
    {
        return JournalSelfstudyDetail::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return JournalSelfstudyDetail::destroy($id);
    }
}
