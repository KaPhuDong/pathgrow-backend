<?php
namespace App\Repositories;

interface JournalInclassRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function getByJournalId($journalId);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
