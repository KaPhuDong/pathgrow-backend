<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelfStudyPlan extends Model
{
    protected $table = 'self_study_plans';
    protected $fillable = ['weekly_study_plan_id'];
    
    public $timestamps = false;

    public function weeklyStudyPlan()
    {
        return $this->belongsTo(WeeklyStudyPlan::class);
    }

    public function selfStudySubjects()
    {
        return $this->hasMany(SelfStudySubject::class);
    }
}
