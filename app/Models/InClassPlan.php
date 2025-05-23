<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InClassPlan extends Model
{
    protected $table = 'in_class_plans';
    protected $fillable = ['weekly_study_plan_id'];

    public $timestamps = false;


    public function weeklyStudyPlan()
    {
        return $this->belongsTo(WeeklyStudyPlan::class);
    }

    public function inClassSubjects()
    {
        return $this->hasMany(InClassSubject::class);
    }
}


