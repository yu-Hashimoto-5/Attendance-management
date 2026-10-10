<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <h2>勤怠一覧</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>出勤</th>
                        <th>退勤</th>
                        <th>休憩時間</th>
                        <th>修正申請</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->date }}</td>
                            <td>{{ $attendance->clock_in }}</td>
                            <td>{{ $attendance->clock_out }}</td>
                            <td>
                                {{ $attendance->breaks->sum(fn($b) => $b->break_start->diffInMinutes($b->break_end)) }} 分
                            </td>
                            <td>
                                <a href="{{ route('attendance.request.form', $attendance->id) }}" class="btn btn-sm btn-info">
                                    修正申請
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $attendances->links() }}
        </div>
    @endsection


</body>

</html>
