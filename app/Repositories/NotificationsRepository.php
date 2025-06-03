<?php
namespace App\Repositories;

use App\Models\Notifications;

class NotificationsRepository
{
    public function getAll()
    {
        return Notifications::orderBy('created_at', 'desc')->get();
    }

    public function getByUser($userId, $perPage = null)
    {
        $query = Notifications::where('user_id', $userId)
            ->orderBy('created_at', 'desc');

        if ($perPage) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function getUnreadByUser($userId)
    {
        return Notifications::where('user_id', $userId)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getById($id)
    {
        return Notifications::find($id);
    }

    public function create(array $data)
    {
        return Notifications::create($data);
    }

    public function markAsRead($id): bool
    {
        return Notifications::where('id', $id)->update(['is_read' => true]) > 0;
    }

    public function delete($id): bool
    {
        return Notifications::destroy($id) > 0;
    }
}
