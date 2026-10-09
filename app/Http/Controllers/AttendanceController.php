<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function clockIn()
    {

        Attendance::firstOrCreate(
            ['user_id' => Auth::id(), 'date' => today()],
            ['clock_in' => now()]
        );

        return back()->with('message', '出勤しました');
    }
    public function clockOut()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->where('date', today())
            ->firstOrFail();

        $attendance->update(['clock_out' => now()]);

        return back()->with('message', '退勤しました');
    }
}
