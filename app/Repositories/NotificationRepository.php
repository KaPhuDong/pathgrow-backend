<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository
{
    public function getAll()
    {
        return Notification::all();
    }

    public function getByUser($userId)
    {
        return Notification::where('user_id', $userId)->get();
    }

    public function getById($id)
    {
        return Notification::find($id);
    }

    public function create(array $data)
    {
        return Notification::create($data);
    }

    public function markAsRead($id)
    {
        return Notification::where('id', $id)->update(['is_read' => true]);
    }

    public function delete($id)
    {
        return Notification::destroy($id);
    }
}
