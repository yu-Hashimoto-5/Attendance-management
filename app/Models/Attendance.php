<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BreakModel;
use App\Models\AttendanceRequest;

class Attendance extends Model
{
    protected $fillable = ['user_id', 'date', 'clock_in', 'clock_out'];

    protected $casts = [
        'date' => 'date',
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function breaks()
    {
        return $this->hasMany(BreakModel::class);
    }
    public function requests()
    {
        return $this->hasMany(AttendanceRequest::class);
    }
}
