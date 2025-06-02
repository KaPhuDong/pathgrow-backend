<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function inClassSubjects()
    {
        return $this->hasMany(InClassSubject::class);
    }

    public function selfStudySubjects()
    {
        return $this->hasMany(SelfStudySubject::class);
    }
    public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id');
}

}
