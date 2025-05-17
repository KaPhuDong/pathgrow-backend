<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalSelfstudyDetail extends Model
{
    protected $table = 'journal_selfstudy_details';

    protected $fillable = [
        'journal_id',
        'date',
        'skills_module',
        'lesson_summary',
        'time_allocation',
        'learning_resources',
        'learning_activities',
        'concentration',
        'plan_follow_reflection',
        'work_evaluation',
        'reinforce_techniques',
        'notes'
    ];
}
