<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\User;

class AttendanceRequest extends Model
{

    protected $fillable = [
        'attendance_id',
        'user_id',
        'request_type',
        'before_value',
        'after_value',
        'reason',
        'status'
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
