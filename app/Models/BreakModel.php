<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class BreakModel extends Model
{
    protected $fillable = ['attendance_id', 'break_start', 'break_end'];
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
