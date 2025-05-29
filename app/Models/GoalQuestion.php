<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'semester_id',
        'subject_id',
        'question',
        'answer',
        'answered_by',
        'answered_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answeredBy()
    {
        return $this->belongsTo(User::class, 'answered_by');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

