@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Дансны дэлгэрэнгүй</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID:</th>
            <td>{{ $account->accid }}</td>
        </tr>
        <tr>
            <th>Хэрэглэгчийн ID:</th>
            <td>{{ $account->user_id }}</td>
        </tr>
        <tr>
            <th>Дансны дугаар:</th>
            <td>{{ $account->accountNum }}</td>
        </tr>
        <tr>
            <th>Нийт нэмсэн:</th>
            <td>{{ $account->totalAdd }}</td>
        </tr>
        <tr>
            <th>Нийт хассан:</th>
            <td>{{ $account->totalSub }}</td>
        </tr>
        <tr>
            <th>Үлдэгдэл:</th>
            <td>{{ $account->balance }}</td>
        </tr>
        <tr>
            <th>Үүсгэсэн огноо:</th>
            <td>{{ $account->createTime }}</td>
        </tr>
        <tr>
            <th>Шинэчилсэн огноо:</th>
            <td>{{ $account->updateTime }}</td>
        </tr>
    </table>
    <a href="{{ route('account.index') }}" class="btn btn-primary">Буцах</a>
</div>
@endsection
