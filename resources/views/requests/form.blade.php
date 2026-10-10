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
            <h2>修正申請</h2>

            <form action="{{ route('attendance.request.store') }}" method="POST">
                @csrf

                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">

                <div class="mb-3">
                    <label>修正項目</label>
                    <select name="request_type" class="form-control">
                        <option value="clock_in">出勤時刻</option>
                        <option value="clock_out">退勤時刻</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>修正前</label>
                    <input type="text" name="before_value" class="form-control" value="{{ $attendance->clock_in }}">
                </div>

                <div class="mb-3">
                    <label>修正後</label>
                    <input type="text" name="after_value" class="form-control">
                </div>

                <div class="mb-3">
                    <label>理由</label>
                    <textarea name="reason" class="form-control"></textarea>
                </div>

                <button class="btn btn-primary">申請する</button>
            </form>
        </div>
    @endsection


</body>

</html>
