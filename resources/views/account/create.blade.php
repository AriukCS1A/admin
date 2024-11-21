@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Шинэ данс үүсгэх</h1>
    <form action="{{ route('account.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Хэрэглэгчийн ID:</label>
            <input type="number" name="user_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="totalAdd" class="form-label">Нийт нэмсэн:</label>
            <input type="number" name="totalAdd" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="totalSub" class="form-label">Нийт хассан:</label>
            <input type="number" name="totalSub" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="balance" class="form-label">Үлдэгдэл:</label>
            <input type="number" name="balance" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Хадгалах</button>
    </form>
</div>
@endsection
