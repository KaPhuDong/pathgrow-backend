<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'student_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'remind_at',
        'notified',
    ];

    // Quan hệ với User (Teacher)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Quan hệ với User (Student)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
