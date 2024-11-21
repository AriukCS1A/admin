@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Данс засах</h1>
    <form action="{{ route('account.update', $account->accid) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="totalAdd" class="form-label">Нийт нэмсэн:</label>
            <input type="number" name="totalAdd" class="form-control" value="{{ $account->totalAdd }}" required>
        </div>
        <div class="mb-3">
            <label for="totalSub" class="form-label">Нийт хассан:</label>
            <input type="number" name="totalSub" class="form-control" value="{{ $account->totalSub }}" required>
        </div>
        <div class="mb-3">
            <label for="balance" class="form-label">Үлдэгдэл:</label>
            <input type="number" name="balance" class="form-control" value="{{ $account->balance }}" required>
        </div>
        <button type="submit" class="btn btn-success">Хадгалах</button>
    </form>
</div>
@endsection
