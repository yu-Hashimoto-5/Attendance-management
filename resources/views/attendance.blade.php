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
            <h2>今日の勤怠</h2>

            <form action="{{ route('attendance.clockIn') }}" method="POST">
                @csrf
                <button class="btn btn-primary">出勤</button>
            </form>

            <form action="{{ route('attendance.clockOut') }}" method="POST" class="mt-2">
                @csrf
                <button class="btn btn-danger">退勤</button>
            </form>

            <form action="{{ route('attendance.breakStart') }}" method="POST" class="mt-2">
                @csrf
                <button class="btn btn-warning">休憩開始</button>
            </form>

            <form action="{{ route('attendance.breakEnd') }}" method="POST" class="mt-2">
                @csrf
                <button class="btn btn-success">休憩終了</button>
            </form>
        </div>
    @endsection


</body>

</html>
