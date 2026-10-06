<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MonthlyClosing extends Model
{
    protected $fillable = [
        'user_id',
        'year_month',
        'total_work_minutes',
        'total_break_minutes',
        'total_days',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
