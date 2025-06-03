<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeeklyGoal extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'weekly_study_plan_id',
        'name',
        'completed',
    ];

    public function weeklyStudyPlan()
    {
        return $this->belongsTo(WeeklyStudyPlan::class);
    }
}
