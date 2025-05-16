<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id','type', 'message', 'is_read'];
}
