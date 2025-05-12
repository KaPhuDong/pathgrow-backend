<?php
// app/Services/JournalSelfstudyService.php
namespace App\Services;

use App\Repositories\JournalSelfstudyRepository;

class JournalSelfstudyService
{
    protected $repo;

    public function __construct(JournalSelfstudyRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll(); // đảm bảo hàm getAll() tồn tại trong repository
    }

    public function getList($journalId)
    {
        return $this->repo->getByJournalId($journalId);
    }
    
    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
