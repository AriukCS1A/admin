@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Данс засах</h1>
    <form action="{{ route('points.update', $points->pointId) }}" method="POST">
        @csrf
        @method('PUT')
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
