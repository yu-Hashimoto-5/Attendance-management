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
            <h2>修正申請一覧</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>ユーザー</th>
                        <th>日付</th>
                        <th>項目</th>
                        <th>修正前</th>
                        <th>修正後</th>
                        <th>理由</th>
                        <th>状態</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $req)
                        <tr>
                            <td>{{ $req->user->name }}</td>
                            <td>{{ $req->attendance->date }}</td>
                            <td>{{ $req->request_type }}</td>
                            <td>{{ $req->before_value }}</td>
                            <td>{{ $req->after_value }}</td>
                            <td>{{ $req->reason }}</td>
                            <td>{{ $req->status }}</td>
                            <td>
                                <form action="{{ route('admin.requests.approve', $req->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">承認</button>
                                </form>

                                <form action="{{ route('admin.requests.reject', $req->id) }}" method="POST" class="mt-1">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">却下</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $requests->links() }}
        </div>
    @endsection


</body>

</html>
