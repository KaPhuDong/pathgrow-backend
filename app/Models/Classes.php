<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'students', 
        'color',
        'slug',
    ];

    // Thêm quan hệ 1 lớp có nhiều học sinh (user role = student)
    public function students()
    {
        // Lọc role = 'student' để chỉ lấy học sinh
        return $this->hasMany(User::class, 'class_id')->where('role', 'student');
    }
}
