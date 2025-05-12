<?php
namespace App\Services;

interface JournalSelfstudyServiceInterface
{
    public function getAll();
    public function getById($id);
    public function getList($selfstudyId);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
