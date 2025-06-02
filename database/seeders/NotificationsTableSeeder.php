<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notifications;
use Illuminate\Support\Facades\DB;

class NotificationsTableSeeder extends Seeder
{
    public function run()
    {
        // Xóa dữ liệu cũ (nếu muốn)
        Notifications::truncate();

        // Tạo mẫu dữ liệu
        Notifications::create([
            'user_id' => 1,                  // ID user có sẵn trong bảng users
            'sender_id' => 2,                // Người gửi thông báo (có thể null)
            'type' => 'info',                // Loại thông báo
            'title' => 'Chào mừng bạn!',    // Tiêu đề
            'message' => 'Chào mừng bạn đến với hệ thống học tập.', // Nội dung
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Notifications::create([
            'user_id' => 1,
            'sender_id' => null,
            'type' => 'reminder',
            'title' => 'Nhắc nhở học tập',
            'message' => 'Bạn có bài kiểm tra vào ngày mai, đừng quên ôn tập nhé!',
            'is_read' => false,
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ]);
    }
}
