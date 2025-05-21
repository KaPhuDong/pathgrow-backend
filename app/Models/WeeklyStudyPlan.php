<?php

namespace App\Models;
use App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeeklyStudyPlan extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['student_id','name', 'start_date', 'end_date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function goals()
    {
        return $this->hasMany(WeeklyGoal::class);
    }

     public function inClassPlan()
    {
        return $this->hasOne(InClassPlan::class);
    }

     public function selfStudyPlan()
    {
        return $this->hasOne(SelfStudyPlan::class);
    }


}

