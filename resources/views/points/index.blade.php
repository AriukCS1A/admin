@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Дансны жагсаалт</h1>
    <a href="{{ route('points.create') }}" class="btn btn-primary mb-3">Шинэ данс үүсгэх</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Хэрэглэгч ID</th>
                <th>нэмсэн</th>
                <th>хассан</th>
                <th>сар өдөр</th>
                <th>Үйлдэл</th>
            </tr>
        </thead>
        <tbody>
            @foreach($points as $points)
            <tr>
                <td>{{ $points->pointId }}</td>
                <td>{{ $points->user_id }}</td>
                <td>{{ $points->added }}</td>
                <td>{{ $points->substracted}}</td>
                <td>{{ $points->transDate }}</td>
                <td>{{ $points->user->lastname }}</td>
                <td>
                    <a href="{{ route('points.show', $points->pointId) }}" class="btn btn-info btn-sm">Харах</a>
                    <a href="{{ route('points.edit', $points->pointId) }}" class="btn btn-warning btn-sm">Засах</a>
                    <form action="{{ route('points.destroy', $points->accid) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Устгах уу?')">Устгах</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
