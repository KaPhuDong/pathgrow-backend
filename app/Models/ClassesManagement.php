<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassesManagement extends Model
{
    use HasFactory;

    protected $table = 'classes';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'students',
        'color',
        'slug',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject', 'class_id', 'subject_id')
                    ->withTimestamps();
    }

    public function students()
    {
        return $this->hasMany(User::class, 'class_id')->where('role', 'student');
    }

    public function teachers()
    {
        return $this->hasMany(User::class, 'class_id')->where('role', 'teacher');
    }

}
