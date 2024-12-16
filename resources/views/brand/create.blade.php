@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Шинэ үүсгэх</h1>
    <form action="{{ route('brand.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Үлдэгдэл:</label>
            <input type="string" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Хадгалах</button>
    </form>
</div>
@endsection
