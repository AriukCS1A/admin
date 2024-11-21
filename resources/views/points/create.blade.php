@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Шинэ үүсгэх</h1>
    <form action="{{ route('points.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Хэрэглэгчийн ID:</label>
            <input type="number" name="user_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="added" class="form-label">нэмсэн:</label>
            <input type="number" name="added" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="substracted" class="form-label">хассан:</label>
            <input type="number" name="substracted" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="transDate" class="form-label">Үлдэгдэл:</label>
            <input type="number" name="transDate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Хадгалах</button>
    </form>
</div>
@endsection
