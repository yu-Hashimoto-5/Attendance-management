<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AdminAttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('user')
            ->orderBy('date', 'desc')
            ->paginate(50);

        return view('admin.attendance.index', compact('attendances'));
    }
}

