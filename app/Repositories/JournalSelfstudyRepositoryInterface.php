<?php
namespace App\Repositories;

interface JournalSelfstudyRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function getBySelfstudyId($selfstudyId);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
