<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\MonthlyClosing;
use App\Models\User;
use Carbon\Carbon;


class MonthlyClosingController extends Controller
{
    public function closeMonth(User $user, $yearMonth)
    {
        [$year, $month] = explode('-', $yearMonth);

        $start = Carbon::create($year, $month, 1);
        $end = $start->copy()->endOfMonth();

        $attendances = Attendance::where('user_id', $user->id)
            ->whereBetween('date', [$start, $end])
            ->with('breaks')
            ->get();

        $totalWork = 0;
        $totalBreak = 0;

        foreach ($attendances as $attendance) {
            if ($attendance->clock_in && $attendance->clock_out) {
                $totalWork += $attendance->clock_in->diffInMinutes($attendance->clock_out);
            }

            foreach ($attendance->breaks as $break) {
                if ($break->break_start && $break->break_end) {
                    $totalBreak += $break->break_start->diffInMinutes($break->break_end);
                }
            }
        }

        MonthlyClosing::create([
            'user_id' => $user->id,
            'year_month' => $yearMonth,
            'total_work_minutes' => $totalWork,
            'total_break_minutes' => $totalBreak,
            'total_days' => $attendances->count(),
        ]);

        return back()->with('message', '月次締めが完了しました');
    }
}
