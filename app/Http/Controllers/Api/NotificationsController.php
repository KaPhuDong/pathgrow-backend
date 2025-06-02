<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifications;

class NotificationsController extends Controller
{
    // Lấy danh sách thông báo của user đăng nhập
    public function index()
    {
        $notifications = Notifications::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    // Tạo mới thông báo (thường gọi từ chỗ khác, có thể làm protected hoặc qua service)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'message' => 'required|string',
            'sender_id' => 'nullable|exists:users,id',
        ]);

        $notification = Notifications::create([
            'user_id' => $request->user_id,
            'sender_id' => $request->sender_id,
            'type' => $request->type,
            'title' => $request->title,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'Notification created successfully',
            'notification' => $notification
        ], 201);
    }

    // Đánh dấu một thông báo đã đọc
    public function markAsRead($id)
    {
        $notification = Notifications::where('user_id', Auth::id())->findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['message' => 'Notification marked as read.']);
    }

    // Đánh dấu tất cả thông báo đã đọc
    public function markAllAsRead()
    {
        Notifications::where('user_id', Auth::id())->where('is_read', false)->update(['is_read' => true]);

        return response()->json(['message' => 'All notifications marked as read.']);
    }

    // Xóa một thông báo (nếu cần)
    public function destroy($id)
    {
        $notification = Notifications::where('user_id', Auth::id())->findOrFail($id);
        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully.']);
    }
}
