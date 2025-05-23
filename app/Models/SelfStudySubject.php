<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelfStudySubject extends Model
{
    protected $table = 'self_study_subject';
    public $timestamps = false;

    protected $fillable = [
        'self_study_plan_id',
        'subject_id',
        'date',
        'my_lesson',
        'time_allocation',
        'learning_resources',
        'learning_activities',
        'concentration',
        'plan_follow_reflection',
        'evaluation',
        'reinforcing_learning',
        'notes',
    ];

    public function selfStudyPlan()
    {
        return $this->belongsTo(SelfStudyPlan::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
