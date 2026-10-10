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
            <h2>月次締め</h2>

            <form action="{{ route('admin.monthly.close', [$user->id, $yearMonth]) }}" method="POST">
                @csrf
                <button class="btn btn-primary">この月を締める</button>
            </form>
        </div>
    @endsection


</body>

</html>
