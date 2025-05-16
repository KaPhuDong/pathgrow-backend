<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\NotificationsRepository;
use App\Models\Notifications;

class NotificationsController extends Controller
{
    protected $repo;

    public function __construct(NotificationsRepository $repo)
    {
        $this->repo = $repo;
    }

    // Lấy tất cả thông báo
    public function index()
    {
        return response()->json($this->repo->getAll());
    }

    // Lấy thông báo theo user
   public function getByUser($id)
{
    if (!\App\Models\User::find($id)) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $notifications = $this->repo->getByUser($id);

    return response()->json($notifications);
}


    // Lấy thông báo theo ID
    // public function show($id)
    // {
    //     $notification = $this->repo->getById($id);

    //     return $notification
    //         ? response()->json($notification)
    //         : response()->json(['message' => 'Not found'], 404);
    // }

    // Tạo mới thông báo
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'message' => 'required|string',
        ]);

        $notification = $this->repo->create($data);

        return response()->json($notification, 201);
    }

    // Đánh dấu đã đọc
    public function markAsRead($id)
    {
        $updated = $this->repo->markAsRead($id);

        return $updated
            ? response()->json(['message' => 'Marked as read'])
            : response()->json(['message' => 'Not found'], 404);
    }

    // Xóa thông báo
    public function destroy($id)
    {
        $deleted = $this->repo->delete($id);

        return $deleted
            ? response()->json(['message' => 'Deleted'])
            : response()->json(['message' => 'Not found'], 404);
    }
}
