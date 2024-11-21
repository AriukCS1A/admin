@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Дансны дэлгэрэнгүй</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID:</th>
            <td>{{ $points->pointId }}</td>
        </tr>
        <tr>
            <th>Хэрэглэгчийн ID:</th>
            <td>{{ $points->user_id }}</td>
        </tr>
        <tr>
            <th>Дансны дугаар:</th>
            <td>{{ $points->added }}</td>
        </tr>
        <tr>
            <th>Нийт нэмсэн:</th>
            <td>{{ $points->substracted}}</td>
        </tr>
        <tr>
            <th>Нийт хассан:</th>
            <td>{{ $points->transDate }}</td>
        </tr>
        <tr>
            <th>Үүсгэсэн огноо:</th>
            <td>{{ $account->createdTime }}</td>
        </tr>
        <tr>
            <th>Шинэчилсэн огноо:</th>
            <td>{{ $account->updatedTime }}</td>
        </tr>
    </table>
    <a href="{{ route('points.index') }}" class="btn btn-primary">Буцах</a>
</div>
@endsection
