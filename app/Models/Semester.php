<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    // Định nghĩa bảng
    protected $table = 'semesters';

    public $timestamps = false;
    protected $fillable = [
        'name',  // Ví dụ về tên học kỳ
    ];

    // Quan hệ với bảng Goal
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
