<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentCalendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'day_of_week',
        'date',
        'start_time',
        'end_time',
        'color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
