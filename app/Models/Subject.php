<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    // Định nghĩa bảng
    protected $table = 'subjects';

    // Các trường có thể gán giá trị (fillable)
    protected $fillable = [
        'name',  // Ví dụ về tên môn học
    ];

    // Quan hệ với bảng Goal
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
