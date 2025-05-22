<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'subjects';
    protected $fillable = [
        'name',  // Ví dụ về tên môn học
    ];

    // Quan hệ với bảng Goal
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
