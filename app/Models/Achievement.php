<?php
    namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Achievement extends Model
{
    use HasFactory;


    // Các cột được phép gán giá trị hàng loạt (mass assignment)
    protected $fillable = [
        'student_id',
        'title',
        'description',
        'image_url',
        'image_public_id'
    ];


    /**
     * Quan hệ với model Student (nếu có model Student)
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
                ->withTimestamps()
                ->withPivot('achieved_at');
    }
}
