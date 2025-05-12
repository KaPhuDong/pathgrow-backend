<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalInclassDetail extends Model
{
    protected $fillable = [
        'journal_id', 'date', 'skills_module', 'lesson_summary',
        'self_assessment', 'difficulties', 'improvement_plan', 'problem_solved'
    ];
}
