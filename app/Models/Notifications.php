<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [
        'user_id',
        'sender_id',
        'type',
        'title',
        'message',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // người nhận
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id'); // người gửi
    }
}
