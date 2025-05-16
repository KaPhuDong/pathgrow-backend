<?php

namespace App\Repositories;

use App\Models\Notifications;

class NotificationsRepository
{
    public function getAll()
    {
        return Notifications::all();
    }

    public function getByUser($userId)
    {
        return Notifications::where('user_id', $userId)->get();
    }

    public function getById($id)
    {
        return Notifications::find($id);
    }

    public function create(array $data)
    {
        return Notifications::create($data);
    }

    public function markAsRead($id)
    {
        return Notifications::where('id', $id)->update(['is_read' => true]);
    }

    public function delete($id)
    {
        return Notifications::destroy($id);
    }
}
