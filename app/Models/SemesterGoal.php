<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemesterGoal extends Model
{
    use HasFactory;
    public $timestamps = false;

    // Định nghĩa bảng
    protected $table = 'semester_goals';

    // Các trường có thể gán giá trị (fillable)
    protected $fillable = [
        'user_id',
        'semester_id',
        'subject_id',
        'expect_course',
        'expect_teacher',
        'expect_myself',
    ];

    // Quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với bảng Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Quan hệ với bảng Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
