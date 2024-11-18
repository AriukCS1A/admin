<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Data</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Laravel CSS -->
</head>
<body>
    <div class="container mt-5">
        <h1>Gift Table Data</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Baby ID</th>
                    <th>Reward ID</th>
                    <th>Granted At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gifts as $gift)
                    <tr>
                        <td>{{ $gift->giftId }}</td>
                        <td>{{ $gift->baby_id }}</td>
                        <td>{{ $gift->reward_id }}</td>
                        <td>{{ $gift->grantedAt }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
