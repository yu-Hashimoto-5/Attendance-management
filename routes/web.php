<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BreakController;
use App\Http\Controllers\AttendanceRequestController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\MonthlyClosingController;

Route::middleware(['auth'])->group(function () {

    // 出勤
    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])
        ->name('attendance.clockIn');

    // 退勤
    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])
        ->name('attendance.clockOut');

    // 休憩開始
    Route::post('/attendance/break-start', [BreakController::class, 'breakStart'])
        ->name('attendance.breakStart');

    // 休憩終了
    Route::post('/attendance/break-end', [BreakController::class, 'breakEnd'])
        ->name('attendance.breakEnd');

    // 自分の勤怠一覧
    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');
});


Route::middleware(['auth'])->group(function () {

    // 修正申請（ユーザー）
    Route::post('/attendance/request', [AttendanceRequestController::class, 'store'])
        ->name('attendance.request.store');
});

Route::middleware(['auth', 'admin'])->group(function () {

    // 修正申請一覧（管理者）
    Route::get('/admin/requests', [AttendanceRequestController::class, 'index'])
        ->name('admin.requests.index');

    // 承認
    Route::post('/admin/requests/{attendanceRequest}/approve',
        [AttendanceRequestController::class, 'approve'])
        ->name('admin.requests.approve');

    // 却下
    Route::post('/admin/requests/{attendanceRequest}/reject',
        [AttendanceRequestController::class, 'reject'])
        ->name('admin.requests.reject');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/attendance', [AdminAttendanceController::class, 'index'])
        ->name('admin.attendance.index');
});


Route::middleware(['auth', 'admin'])->group(function () {

    Route::post('/admin/monthly-close/{user}/{yearMonth}',
        [MonthlyClosingController::class, 'closeMonth'])
        ->name('admin.monthly.close');
});
