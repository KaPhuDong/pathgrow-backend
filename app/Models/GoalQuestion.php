<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalQuestion extends Model
{
    use HasFactory;

    // Định nghĩa bảng
    protected $table = 'goal_questions';

    // Các trường có thể gán giá trị (fillable)
    protected $fillable = [
        'user_id',
        'semester_id',
        'subject_id',
        'question',
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
