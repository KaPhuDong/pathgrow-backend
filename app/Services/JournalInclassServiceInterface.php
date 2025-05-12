<?php
namespace App\Services;

interface JournalInclassServiceInterface
{
    public function getAll();
    public function getById($id);
    public function getList($journalId);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
