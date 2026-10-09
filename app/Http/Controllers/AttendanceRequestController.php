<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\AttendanceRequest;

class AttendanceRequestController extends Controller
{
    public function store(Request $request)
    {
        $attendance = Attendance::findOrFail($request->attendance_id);

        AttendanceRequest::create([
            'attendance_id' => $attendance->id,
            'user_id' => Auth::id(),
            'request_type' => $request->request_type,
            'before_value' => $request->before_value,
            'after_value' => $request->after_value,
            'reason' => $request->reason,
        ]);

        return back()->with('message', '修正申請を送信しました');
    }
    public function index()
    {
        $requests = AttendanceRequest::with('attendance', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('admin.requests.index', compact('requests'));
    }

    // public function approve(AttendanceRequest $request)
    // {
    //     $attendance = $request->attendance;

    //     $attendance->update([
    //         $request->request_type => $request->after_value
    //     ]);

    //     $request->update(['status' => 'approved']);

    //     return back()->with('message', '承認しました');
    // }
    // public function reject(AttendanceRequest $request)
    // {
    //     $request->update(['status' => 'rejected']);

    //     return back()->with('message', '却下しました');
    // }
    public function approve(AttendanceRequest $attendanceRequest)
    {
        $attendance = $attendanceRequest->attendance;

        $attendance->update([
            $attendanceRequest->request_type => $attendanceRequest->after_value
        ]);

        $attendanceRequest->update(['status' => 'approved']);

        return back()->with('message', '承認しました');
    }

    public function reject(AttendanceRequest $attendanceRequest)
    {
        $attendanceRequest->update(['status' => 'rejected']);

        return back()->with('message', '却下しました');
    }
}
