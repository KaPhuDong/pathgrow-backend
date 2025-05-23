<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InClassSubject extends Model
{
    protected $table = 'in_class_subject';
    public $timestamps = false;

    protected $fillable = [
        'in_class_plan_id',
        'subject_id',
        'date',
        'my_lesson',
        'self_assessment',
        'my_difficulties',
        'my_plan',
        'problem_solved',
    ];

    // public function inClassPlan()
    // {
    //     return $this->belongsTo(InClassPlan::class);
    // }

    // public function subject()
    // {
    //     return $this->belongsTo(Subject::class);
    // }
    
    public function inClassPlan()
    {
        return $this->belongsTo(InClassPlan::class);
    }
}
