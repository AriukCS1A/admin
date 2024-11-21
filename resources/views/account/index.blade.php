@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Дансны жагсаалт</h1>
    <a href="{{ route('account.create') }}" class="btn btn-primary mb-3">Шинэ данс үүсгэх</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Хэрэглэгч ID</th>
                <th>Дансны дугаар</th>
                <th>Нийт нэмсэн</th>
                <th>Нийт хассан</th>
                <th>Үлдэгдэл</th>
                <th>Үйлдэл</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accounts as $account)
            <tr>
                <td>{{ $account->accid }}</td>
                <td>{{ $account->user_id }}</td>
                <td>{{ $account->accountNum }}</td>
                <td>{{ $account->totalAdd }}</td>
                <td>{{ $account->totalSub }}</td>
                <td>{{ $account->balance }}</td>
                <td>{{ $account->user->lastname }}</td>
                <td>
                    <a href="{{ route('account.show', $account->accid) }}" class="btn btn-info btn-sm">Харах</a>
                    <a href="{{ route('account.edit', $account->accid) }}" class="btn btn-warning btn-sm">Засах</a>
                    <form action="{{ route('account.destroy', $account->accid) }}" method="POST" style="display:inline;">
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
