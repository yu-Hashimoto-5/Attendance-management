<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\BreakModel;

class BreakController extends Controller
{
    public function breakStart()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', today())
            ->firstOrFail();

        BreakModel::create([
            'attendance_id' => $attendance->id,
            'break_start' => now(),
        ]);

        return back()->with('message', '休憩開始');
    }
    public function breakEnd()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', today())
            ->firstOrFail();

        $break = BreakModel::where('attendance_id', $attendance->id)
            ->whereNull('break_end')
            ->firstOrFail();

        $break->update(['break_end' => now()]);

        return back()->with('message', '休憩終了');
    }
}
